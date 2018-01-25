//dragging functions for interactive map
var dragStart = 0;
var dragEnd = 0;
var isDragging = false;

var basePageURL = '';
var requestContinueAllowed = false;
var countsAsLeave = true;

/**
 * Binds the calendar nav
 * For using the calendar
 */
function bind_calendar_nav() {

    //set the entitlement year
    var theYear = $('#currentYear').text();
    var currentYear = $('#calendar_year_choice').val();

    if (currentYear != undefined && (theYear != currentYear)) {
        $('#calendar_year_choice').val(theYear);
        bindYearOption(theYear);
    }

    $('#request_calendar th a').click(function () {
        clearDateOutput();

        getCalendarData($(this).attr('href'));
        return false;
    });

    $('.no_date_data').on('click', function () {

        clearDateOutput();

        var thisDate = $(this).text() + ' ' + $('.calendar_month').text();
        var this_link = $(this);
        var contentHtml = '' +
            '<form name="submit_single_day" id="submit_single_day">' +
            '<h4>Leave Type for "' + thisDate + '"</h4>' +
            '<p>Please choose the reason</p>' +
            '<p>' + $('#attendance_type_drop_options_container').html() + '</p>' +
            '<div id="further_information_choices" style="display:none" >' +
            '<div id="extra_attendance_information"></div>' +
            '<p>Please choose whether you want a "half day" or a "full day".</p>' +
            '<p><select id="durationChoice" name="durationChoice">' +
            '<option value="">Please Select...</option>' +
            '<option value="0.5">Half Day</option>' +
            '<option value="1">Full Day</option>' +
            '</select>' +
            '</p>' +
            '<div id="half_day_choice">' +
            '<p>Please select Morning or Afternoon' +
            '</p><p><select id="period_choice" name="period_choice"><option value="">Please Select...</option><option value="am">Morning</option><option value="pm">Afternoon</option></select></p></div><p><a href="javascript:;" id="submitSingleDate" class="btn btn-primary">Submit Date</a></p>' +
            '</div></form>';

        $('#holidayCalendarFormContainer').html(contentHtml);

        $('#holidayCalendarFormContainer #attendance_types').bind('change', function () {

            var choice = $(this).val();
            monitorAttendanceChoices(choice);

            //set in monitorAttendanceChoices() - for now
            if (requestContinueAllowed) {

                $('#durationChoice').bind('change', function () {
                    if ($(this).val() == '0.5') {
                        $('#half_day_choice').show();
                    } else {
                        $('#half_day_choice').hide();
                    }
                });

                //remove any previous click bindings
                $('#submitSingleDate').unbind();

                $('#submitSingleDate').bind('click', function () {

                    var theForm = $('#submit_single_day');

                    theForm.validate({
                        rules: {
                            durationChoice: {
                                required: true,
                            },
                            period_choice: {
                                required: function (element) {
                                    if ($('#durationChoice') == '0.5') {
                                        return false;
                                    } else {
                                        return true;
                                    }
                                }
                            }
                        }
                    });

                    if (theForm.valid()) {

                        if (calculateLeavePermission($('#durationChoice').val())) {

                            var token = $("input[name=_token]").val()
                            var durationChoice = $('#durationChoice').val();
                            var periodChoice = $('#period_choice').val();
                            var attendanceType = $('#holidayCalendarFormContainer #attendance_types').val();

                            if (periodChoice == '') {
                                periodChoice = 'NA';
                            }

                            addIntermediate('<div style="text-align: center; padding:25px 10px"><p>Submitting Request...</p><p>', '</p></div>', 'holidayCalendarFormContainer');

                            $.post('/attendance/save-request', {

                                requested_date: thisDate,
                                _token: token,
                                duration: durationChoice,
                                period_choice: periodChoice,
                                holiday_request_type_id: attendanceType,
                                user_id: $('#viewing_user').text()

                            }, function (data) {

                                //not sure why this is picking up its parent without going to the td - 2 steps
                                this_link.parents('td').children('div').addClass('date_awaiting_authorisation').addClass('date_added');

                                clearDateOutput();

                                var calendarLink = basePageURL + '/?year=' + $('#currentYear').text() + '&month=' + $('#currentMonth').text();

                                getCalendarData(calendarLink);
                                getBalances($('#currentYear').text());

                            });

                        } else {

                            var contentHtml = '<h4>Leave Type for "' + thisDate + '"</h4><p>Sorry, you have insufficient leave for this year to perform this request. Please contact your manager if this seems incorrect.</p>';

                            $('#holidayCalendarFormContainer').html(contentHtml);

                        }

                    } else {
                        return false;
                    }

                });

            }

        });


    });

    $('.date_added').on('click', function () {
        var selectedDate = $(this).children('.holiday_request_date_id').text();
        $.get('/attendance/date-details/' + selectedDate, function (data) {
            $('#holidayCalendarFormContainer').html(data);
            $('#delete_holiday_request').bind('click', function () {
                if (confirm('Are you sure you want to cancel this request?')) {
                    $.get('/attendance/delete-request/' + $('#delete_holiday_request_id').text(), function () {
                        clearDateOutput();
                        var calendarLink = basePageURL + '/?year=' + $('#currentYear').text() + '&month=' + $('#currentMonth').text();
                        getCalendarData(calendarLink);
                        getBalances($('#currentYear').text());
                    })
                }
            });
        });
    });

    $('#request_calendar table td').mousedown(rangeMouseDown).mouseup(rangeMouseUp).mousemove(rangeMouseMove);

}

function rangeMouseDown(e) {
    if (isRightClick(e)) {
        return false;
    } else {
        var allCells = $("#request_calendar table td");
        dragStart = allCells.index($(this));
        isDragging = true;

        if (typeof e.preventDefault != 'undefined') {
            e.preventDefault();
        }
        document.documentElement.onselectstart = function () {
            return false;
        };
    }
}

function rangeMouseUp(e) {

    if (isRightClick(e)) {
        return false;
    } else {
        var allCells = $("#request_calendar table td");
        dragEnd = allCells.index($(this));

        isDragging = false;
        if (dragEnd != 0) {
            selectRange();
        }

        document.documentElement.onselectstart = function () {
            return true;
        };
    }

    //leave old system as is - i.e. edit one date
    if ($("#request_calendar table td.selected").length > 1) {
        do_multiples();
    }

}

function rangeMouseMove(e) {
    if (isDragging) {
        var allCells = $("#request_calendar table td");
        dragEnd = allCells.index($(this));
        selectRange();
    }
}

function selectRange() {
    $("#request_calendar table td").removeClass('selected');
    if (dragEnd + 1 < dragStart) { // reverse select
        $("#request_calendar table td").slice(dragEnd, dragStart + 1).addClass('selected');
    } else {
        $("#request_calendar table td").slice(dragStart, dragEnd + 1).addClass('selected');
    }
}

function isRightClick(e) {
    if (e.which) {
        return (e.which == 3);
    } else if (e.button) {
        return (e.button == 2);
    }
    return false;
}

/**
 * Fetches data for binding
 * @param URL to pull the data
 */
function getCalendarData(link) {

    $.get(link, function (data) {
        $('#holidayCalendarContainer').html(data);
        bind_calendar_nav();
    });

}

/**
 * Calculates whether or not the user can submit a request dependent on the leave they have in the system
 * This is checked on back end too
 * @returns {boolean}
 */
function calculateLeavePermission(requestLeaveAmount) {

    if ($('#total_adjusted_leave').length != 0) {
        var totalLeave = $('#total_adjusted_leave').text();
    } else {
        var totalLeave = $('#default_days_leave').text();
    }

    totalLeave = parseFloat(totalLeave);

    totalLeaveRequestedToDate = parseFloat($('#requested_leave').text()) + parseFloat($('#authorised_leave').text());

    if (!countsAsLeave) {
        return true;
    } else if (totalLeave > requestLeaveAmount) {
        return true;
    } else {
        return false
    }

}

/**
 * Get Balances for the year - receiving route has a default
 * @param year
 */
function getBalances(year) {

    clearDateOutput();
    addIntermediate('<div style="text-align: center; padding:25px 10px"><p>Refreshing Data...</p><p>', '</p></div>', 'holidayBalanceContainer');

    if (year == undefined) {
        year = new Date().getFullYear();
    }

    $.get('/attendance/balances/act_as/' + $('#viewing_user').text() + '/', {
        calendar_year: year
    }, function (data) {
        $('#holidayBalanceContainer').html(data);
    })
}

/**
 * Looks at the attendance choices and updates output and sets the ability to proceed
 * @param choice
 */
function monitorAttendanceChoices(choice) {

    if (choice != '') {

        choice = choice - 1;

        var choiceOptions = attendance_type_options[choice];

        $('#extra_attendance_information').html('<p>Please note:</p>');

        if (choiceOptions['counts_as_leave'] == 1) {
            countsAsLeave = true;
            $('#extra_attendance_information').append('<p>This counts as leave</p>');
        } else {
            //stops the balance check
            countsAsLeave = false;
            $('#extra_attendance_information').append('<p>This doesn\'t count as leave</p>');
        }

        if (choiceOptions['needs_approval'] == 1) {
            $('#extra_attendance_information').append('<p>This needs approval</p>');
        } else {
            $('#extra_attendance_information').append('<p>This doesn\'t need approval</p>');
        }

        $('#further_information_choices').show();

        requestContinueAllowed = true;

    } else {

        requestContinueAllowed = false;
        $('#further_information_choices').hide();

    }

}

/**
 * Helper function for adding "loading symbol"
 * @param preHtml
 * @param postHtml
 */
function addIntermediate(preHtml, postHtml, elementID) {

    if (!preHtml) {
        preHtml = '';
    }

    if (!postHtml) {
        postHtml = '';
    }

    $('#' + elementID).html(preHtml + '<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>' + postHtml);

}

/**
 * Helper function for clearing the calendar
 */
function clearDateOutput() {
    $('#holidayCalendarFormContainer').html('');
}

/**
 * This binds the actions so that multiple requests can be sent in one request
 */
function do_multiples() {

    //check number of days - may have a number of
    var totalDays = $('#request_calendar table td.selected div').length;

    //start the selection
    var choices_html = '<h4>Apply for the following leave</h4><div id="multiple_edit_date_selection">';

    $('#request_calendar table td.selected div').each(function () {
        if ($(this).hasClass('no_date_data')) {
            var aLink = $(this).children('a');
            choices_html += aLink.html() + ' ' + $('.calendar_month').text() + '<br />';
        }
    });

    choices_html += '</div>';

    choices_html += '<form id="submit_multiple_dates_form" name="submit_multiple_dates_form"><p style="margin: 10px 0; color: #3e8f3e;">Please select the reason:</p>' +
        '<p>' + $('#attendance_type_drop_options_container').html() + '</p>' +
        '<div id="extra_attendance_information"></div>' +
        '<p><a href="javascript:;" id="submitMultipleDates" class="btn btn-primary">Submit These Dates</a></p></form>';

    $('#holidayCalendarFormContainer').html(choices_html);

    $('#holidayCalendarFormContainer #attendance_types').bind('change', function () {

        var choice = $(this).val();

        //trigger default choice
        monitorAttendanceChoices(choice);

    });

    $('#submitMultipleDates').unbind();

    $('#submitMultipleDates').bind('click', function () {

        if (calculateLeavePermission(totalDays)) {

            var theForm = $('#submit_multiple_dates_form');

            theForm.validate({
                rules: {
                    attendance_type: {
                        required: true
                    }
                }
            });

            if (theForm.valid()) {

                var requestedDates = $('#multiple_edit_date_selection').html();
                var token = $("input[name=_token]").val();
                var attendanceType = $('#holidayCalendarFormContainer #attendance_types').val();

                addIntermediate('<div style="text-align: center; padding:25px 10px"><p>Submitting Request...</p><p>', '</p></div>', 'holidayCalendarFormContainer');

                $.post('/attendance/multiple-dates', {
                    requested_dates: requestedDates,
                    holiday_request_type_id: attendanceType,
                    user_id: $('#viewing_user').text(),
                    _token: token
                }, function (data) {

                    data = $.parseJSON(data);

                    if (data.result == 'success') {

                        clearDateOutput();

                        var calendarLink = basePageURL + '/?year=' + $('#currentYear').text() + '&month=' + $('#currentMonth').text();
                        getCalendarData(calendarLink);
                        getBalances($('#currentYear').text());
                    }

                });
            } else {
                return false;
            }

        } else {

            var contentHtml = '<h4>Sorry</h4><p>You have insufficient leave for this year to perform this request. Please contact your manager if this seems incorrect or remove some requests that have already been submitted</p>';

            $('#holidayCalendarFormContainer').html(contentHtml);

        }

    });


}

function bindYearOption(value) {
    var yearChoice = value;
    getBalances(yearChoice);
}

$(document).ready(function () {

    basePageURL = $('#page_base_url').text();

    getBalances();
    bind_calendar_nav();
});