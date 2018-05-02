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
        if(this.id == Paramval){
            $(this).attr('selected', true);
        }
    });

    $('#buildings').change(function () {
        var id = $(this).children(":selected").attr("id");
        areaUrl(id)
    });
});

function tableSelector() {

}

function areaUrl(id) {
    url =  window.location.href;
    paramName = 'area';
    paramValue = id;
    var pattern = new RegExp('('+paramName+'=).*?(&|$)')
    var newUrl = url.replace(pattern,'$1' + paramValue + '$2');
    var n=url.indexOf(paramName);
    if(n == -1){
        newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue
    }
    window.location.href = newUrl;

}

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
};