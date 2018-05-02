var dataArray = [];
var areaId = 0;

$(document).ready(function () {
    var x = 0;
    var $container = $('tr #no_Bookings');
    var color = 'white';
    $container.mousedown(function () {
        x = 0;

        color = 'red';
        $(this).css({
            'background-color': color
        });
        var classBooking = this.className;
        classBooking = classBooking.split(',');

        var id = classBooking[0];
        var roomName = classBooking[1];
        var bookingTime = classBooking[2];

        console.log('start');
        console.log(id + ' ' + roomName + ' ' + bookingTime);

        $container.mouseover(function () {
            $(this).css({
                'background-color': color
            })
        });

        $container.mouseup(function (e) {
            color = 'white';
            $container.css({
                'background-color': 'white'
            });
            var classBookingEnd = this.className;
            classBookingEnd = classBookingEnd.split(',');
            var classBookingEndTime = classBookingEnd[2];
            var endId = classBookingEnd[0];

            if (id !== endId) {
            } else {
                console.log('end');
                console.log(classBookingEndTime);
                if (x === 0) {
                    roomBooking(roomName, bookingTime, classBookingEndTime);
                }
                x++;
            }
        });

    });

    var bookingStartCount = 0;
    var checker = 0;
    var name = '';
    var i = 0;

    $(function () {
        var $container = $('body');
        var $selection = $('<div class="selection-box">');

        $container.on('mousedown', function (e) {
            var click_y = e.clientY;
            var click_x = e.clientX;

            $selection.css({
                'top': click_y,
                'left': click_x,
                'width': 0,
                'height': 0
            });
            $selection.appendTo($container);

            $container.on('mousemove', function (e) {
                var move_x = e.clientX,
                    move_y = e.clientY,
                    width = Math.abs(move_x - click_x),
                    height = Math.abs(move_y - click_y),
                    new_x, new_y;

                new_x = (move_x < click_x) ? (click_x - width) : click_x;
                new_y = (move_y < click_y) ? (click_y - height) : click_y;

                $selection.css({
                    'width': width,
                    'height': height,
                    'top': new_y,
                    'left': new_x
                });
            }).on('mouseup', function (e) {
                $container.off('mousemove');
                $selection.remove();
            });
        });
    });

    $(this).find('.room_Booked').each(function () {

        if (this.id === 'room_Booked_Start') {
            i++;
            bookingStartCount = 0;
            name = $(this).html();
            this.id = 'number' + i;
            checker = 1;
        }

        if (checker === 1) {
            bookingStartCount++;
        }

        if (this.id === 'room_Booked') {
            this.remove();
        }

        if (checker === 1 && this.id === 'room_Booked_End') {
            this.remove();
            checker = 0;
            $('#number' + i).attr('colspan', bookingStartCount);
        }

    });

    $('#buildings').find('option').each(function () {
        var Paramval = $.urlParam('area');
        areaId = Paramval;
        if (this.id == Paramval) {
            $(this).attr('selected', true);
        }
    });

    $('#buildings').change(function () {
        var id = $(this).children(":selected").attr("id");
        areaUrl(id);
    });


});

function areaUrl(id) {
    url = window.location.href;
    paramName = 'area';
    paramValue = id;
    var pattern = new RegExp('(' + paramName + '=).*?(&|$)')
    var newUrl = url.replace(pattern, '$1' + paramValue + '$2');
    var n = url.indexOf(paramName);
    if (n == -1) {
        newUrl = newUrl + (newUrl.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue
    }
    window.location.href = newUrl;
}

$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
};

function roomBooking(roomName, startTime, endTime) {
    dataArray = [roomName, startTime, endTime];

    $('#powhrModal').on('show.bs.modal', function (event) {
        var modal = $(this);
        modal.find('.modal-title').html('Room Booking Modal for ' + "<h4 id='room-Name'>" + roomName + "</h4>");

        modal.find('.modal-body').html(
            "<table class='table'><thead><tr>" +
            "<th>Room Name</th>" +
            "<th>Start Time</th>" +
            "<th>End Time</th>" +
            "</tr>" +
            "</thead>" +
            "<tbody><tr>" +
            "<td><h5>" + roomName + "</h5></td>" +
            "<td><h5>" + startTime + "</h5></td>" +
            "<td><h5>" + endTime + "</h5></td>" +
            "</tr></tbody>" +
            "</table>"
        );
        modal.find('.modal-footer').html('<button type="btn-primary" class="close" data-dismiss="modal" aria-label="Close" onclick="saveModalData()">Save</button>')
    });

    $('#powhrModal').modal({
        keyboard: false
    });
}

function saveModalData() {
    $('#powhrModal').modal('hide');


    $.post('/room-booking/add-booking', {
        room_Name: dataArray[0],
        start_Time: dataArray[1],
        end_Time: dataArray[2],
        area_Id: areaId,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function () {
        alert('success');
    });
}