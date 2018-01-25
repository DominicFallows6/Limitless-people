$('#attendance_types').append($('<option>', {value:''}).text('Please Select...'));
$(attendance_type_options).each(function(key, value){
    $('#attendance_types').append($('<option>', {value:value['id']}).text(value['holiday_request_type_name']));
});