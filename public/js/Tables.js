var dataArray = [];
var areaId = 0;

$(document).ready(function () {

    var Parameter = getAllUrlParams().room;

    if (typeof(Parameter) == "undefined") {
        $('#roomSelector').hide();
    } else {
        $('#roomSelector').show();
        weekRoomSelector();
    }

    $('tr #no_Bookings').mousedown(function () {
        console.log('down');
    });
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

        // console.log('start');
        // console.log(id + ' ' + roomName + ' ' + bookingTime);
        var newElem;

        $container.mouseover(function () {

            // console.log($(this).css("background-color"));
            if ($(this).css("background-color") !== 'rgb(255, 0, 0)') {
                // console.log('red');
                $(this).css({
                    'background-color': color
                });
            } else {
                $(newElem).css({
                    'background-color': 'white'
                })
            }
            newElem = this;
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
                if (x === 0 && (new Date('1/1/1999 ' + bookingTime) < new Date('1/1/1999 ' + classBookingEndTime)) === true) {
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
        areaUrl(id)
    });

});
function areaUrl(id) {
    url = window.location.href;
    paramName = 'area';
    paramValue = id;
    var pattern = new RegExp('(' + paramName + '=).*?(&|$)');
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

    if (dataArray[1] !== dataArray[2]) {

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
                "</table><br><hr>" +
                "<p>**(Add users to this booking)**</p>" +
                "<p>**(Button for booking all day/week/year / Multiple days using a calander)**</p>"
            );
            modal.find('.modal-footer').html('<button type="btn-primary" class="close" data-dismiss="modal" aria-label="Close" onclick="saveModalData()">Save</button>')
        });

        $('#powhrModal').modal({
            keyboard: false
        });
    }
}

function saveModalData() {
    $('#powhrModal').modal('hide');

    $.post('/room-booking/add-booking', {
        room_Name: dataArray[0],
        start_Time: dataArray[1],
        end_Time: dataArray[2],
        area_Id: areaId,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function (Data) {
        if (Data == 'true') {
            location.reload();
        } else {
            alert('error');
        }
    });
}

function getAllUrlParams(url) {
    // get query string from url (optional) or window
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

    // we'll store the parameters here
    var obj = {};

    // if query string exists
    if (queryString) {

        // stuff after # is not part of query string, so get rid of it
        queryString = queryString.split('#')[0];

        // split our query string into its component parts
        var arr = queryString.split('&');

        for (var i = 0; i < arr.length; i++) {
            // separate the keys and the values
            var a = arr[i].split('=');

            // in case params look like: list[]=thing1&list[]=thing2
            var paramNum = undefined;
            var paramName = a[0].replace(/\[\d*\]/, function (v) {
                paramNum = v.slice(1, -1);
                return '';
            });

            // set parameter value (use 'true' if empty)
            var paramValue = typeof(a[1]) === 'undefined' ? true : a[1];

            // (optional) keep case consistent
            paramName = paramName.toLowerCase();
            paramValue = paramValue.toLowerCase();

            // if parameter name already exists
            if (obj[paramName]) {
                // convert value to array (if still string)
                if (typeof obj[paramName] === 'string') {
                    obj[paramName] = [obj[paramName]];
                }
                // if no array index number specified...
                if (typeof paramNum === 'undefined') {
                    // put the value on the end of the array
                    obj[paramName].push(paramValue);
                }
                // if array index number specified...
                else {
                    // put the value at that index number
                    obj[paramName][paramNum] = paramValue;
                }
            }
            // if param name doesn't exist yet, set it
            else {
                obj[paramName] = paramValue;
            }
        }
    }

    return obj;
}

function weekRoomSelector() {

    $('#roomSelect').find('option').each(function () {
        var Paramval = getAllUrlParams().room;
        if (this.id == Paramval) {
            $(this).attr('selected', true);
        }
    });

    $('#roomSelect').change(function () {
        var id = $(this).children(":selected").attr("id");
        url = window.location.href;
        paramName = 'room';
        paramValue = id;
        var pattern = new RegExp('(' + paramName + '=).*?(&|$)');
        var newUrl = url.replace(pattern, '$1' + paramValue + '$2');
        var n = url.indexOf(paramName);
        if (n == -1) {
            newUrl = newUrl + (newUrl.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue
        }
        window.location.href = newUrl;
    });

}