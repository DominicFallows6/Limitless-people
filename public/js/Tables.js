$(document).ready(function () {
    var bookingStartCount = 0;
    var checker = 0;
    var name = '';
    var i = 0;

    $(this).find('.room_Booked').each(function () {

        if (this.id === 'room_Booked_Start') {
            i++;
            bookingStartCount = 0;
            name = $(this).html();
            this.id = i;
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
            $('#' + i).attr('colspan', bookingStartCount);
        }

    });



});