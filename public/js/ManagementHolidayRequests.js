$(document).ready(function () {

    $('#powhrModal').on('show.bs.modal', function (event) {

        var modal = $(this);
        var button = $(event.relatedTarget);
        var userId = button.data('userid');

        modal.find('.modal-title').html('Requests for user '+button.data('username'));

        $.get('/attendance/requests-for-staff/'+userId, function(data) {

            modal.find('.modal-body').html(data);

            $('.leaveResponse').each(function(i){

                $(this).bind('click', function(){

                    var thisHR = $(this);
                    var parentRow = thisHR.parents('tr');

                    //turn any options in to arrows
                    //loop in case any further options added
                    var cells = $(this).parent('td').parent('tr').children('.response-cell');
                    cells.each(function(){
                        $(this).html('<i class="fa fa-refresh fa-spin fa-fw"></i>');
                    });

                    var requestID = thisHR.data('requestid');
                    var responseType = thisHR.data('responsetype');

                    $.post('/attendance/request-response', {
                        requestId: requestID,
                        responseType: responseType,
                        _token: $("input[name=_token]").val()
                    }, function(data){
                        data = $.parseJSON(data);
                        if (data.response == 'success') {
                            parentRow.remove();
                        }
                    });

                });
            });
        });

    });

    $('.reviewHolidayRequests').click(function() {

        $('#powhrModal').modal({
            keyboard: false
        });

    });

});