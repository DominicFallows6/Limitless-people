$(document).ready(function () {
    $(this).find('td').each(function () {
        if (this.id === 'booked') {
            this.attr('class', 'room_Booked');
        }
    })
});
