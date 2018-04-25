$(document).ready(function () {
    var user_Id = 0;
    var time = '';
    $(this).find('td').each(function () {
        if (this.id === 'booked') {
            this.attr('class', 'room_Booked');
        }
    })
}
