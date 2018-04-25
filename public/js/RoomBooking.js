$(document).ready(function () {
    var roomFull;

    $('#BookingBlock').find('div').each(function () {
        $(this).on('click', function () {
            $('#BookingBlock').find('div').each(function () {
                $(this).css('background-color', '');
            });
            $('#monthDateInput').show();
            $(this).css('background-color', 'rgba(14, 138, 210, 0.39)');

            $.get('/room-booking/room-info', {
                room_number: this.id
            }, function (data) {
                var roomInformation = JSON.parse(data);
                $('#roomSeats').html(roomInformation[0]["room_seats"]);

                if (roomInformation[0]["is_full"] == 0) {
                    roomFull = 'No';
                    $('#fullLabel').css('background-color', '')
                } else {
                    roomFull = 'Yes';
                    $('#fullLabel').css('background-color', 'red');
                    $('#fullLabel').css('border-radius', '6px')
                }
                $('#isFull').html(roomFull);

            });
        });
    });

    $.ajax({
        type: 'get',
        url: '/room-booking/get-booked-rooms',
        success: function (data) {
            showBookedRooms(data);
        }
    });


    $('#roomBookingDateSelect').children().hide();

});

function deleteRoom(id) {

    $.post('/room-booking-admin/delete-room', {
        room_id: id,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function (data) {
        if (JSON.parse(data) === true) {
            $('#' + id).parent('#allRoomsAdmin').fadeOut(500), function () {
                $('#' + id).parent('#allRoomsAdmin').remove();
            };
            $('#' + id).parent().html('<h4>deleted</h4>' + '<hr>');
            $('#allRoomsAdmin h4').fadeOut(900).css('background-color', 'red').css('border-radius', '6px');
        } else {
            alert('something went wrong!')
        }
    });

}

function editRoom(id) {

    if ($('#' + id).parent('#allRoomsAdmin').hasClass('.allRoomsInAdmin') === true) {
        console.log('no');
        return false;
    } else {

        $('#' + id).parent().children('#edit_room_name').replaceWith("<label for='edit_room_name'>Room name: <input id='edit_room_name_choice' type='text'></label> <br>");

        $('#' + id).parent().children('#edit_building_id').replaceWith("<label for='edit_building_id'>Building id: <select id='edit_building_choice' name=\"room_building\">\n" +
            "                <option selected disabled>Select a building</option>\n" +
            "                <option value=\"1\">L1</option>\n" +
            "                <option value=\"2\">L2</option>\n" +
            "            </select></label> <br>");

        $('#' + id).parent().children('#edit_room_seats').replaceWith("<label for='edit_room_seats'>Room seats: <input id='edit_room_seats_choice' type='text'></label>");
        $('#' + id).parent().children('#editor' + id).append('<input class="btn-primary" type="submit" onclick="postEdit(' + id + ', 0)">');
        $('#' + id).parent().children('#editor' + id).append('<input class="btn-primary" type="submit" onclick="postEdit(0 ,0)" value="Cancel">')

        $('#' + id).parent().attr('class', 'newclass');

        $('.allRoomsInAdmin').fadeOut(500);
    }
}

function postEdit(id, cancel) {
    if (id == 0 && cancel == 0) {
        window.location.reload();
    }

    var edited_name;
    var edited_building;
    var edited_seats;

    edited_name = $('#edit_room_name_choice').val();
    edited_building = $('#edit_building_choice').val();
    edited_seats = $('#edit_room_seats_choice').val();

    $.post('/room-booking-admin/edit-room', {
        room_id: id,
        room_name: edited_name,
        room_building: edited_building,
        room_seats: edited_seats,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function () {
        window.location.reload();
    });
}

function changeBuilding(room) {

    var buidingId;
    var changeValue;

    changeValue = $("#room-name").text();

    if (changeValue == 'L1' && room == 'Next') {
        $("#room-name").html('L2')
    } else if (changeValue == 'L2' && room == 'Prev') {
        $("#room-name").html('L1')
    } else {
        $("#room-name").html('L1')
    }

    if (changeValue == 'L1') {
        buidingId = '2'
    } else {
        buidingId = '1'
    }

    $.get('/room-booking/more-rooms', {
        building_id: buidingId
    }, function (data) {
        $('#viewRoomLayout').html(data);
    });
}

//this is for putting the data into the table
function showBookedRooms(data) {
    var newInformation = JSON.parse(data);
    var roomId;
    $.each(newInformation, function (i, val) {
        roomId = val['room_information_id'];
        $.ajax({
            data: {id: roomId},
            type: 'get',
            url: '/room-booking/get-new-room-information',
            success: function (data) {
                var newData = JSON.parse(data);
                var buildingId = newData[0]['building_id'];
                var startdates = newData[0]['requested_date'].toString().split('-');
                var roomId = newData[0]['room_information_id'];
                var roomName = newData[0]['room_name'];
                var enddates = newData[0]['requested_date_end'].toString().split('-');

                tableHeaders = $('<th></th>').attr({'data-room': newData[0]['room_information_id'], 'style': 'width: 20%'});
                tableATag = $('<a>' + roomName + '</a>').attr({'href': 'room-booking' + '?year=' + startdates[0] + '&month=' + startdates[1] + '&day=' + startdates[2] + '&area=' + buildingId + '&room=' + roomId,
                    'title': 'View Week ' + roomName  });

                tableATag.appendTo(tableHeaders);
                tableHeaders.appendTo('#table_first');
            }
        });
    });
}