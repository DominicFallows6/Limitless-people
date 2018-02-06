<?php
//print_r($data['requests']);

$template = '{table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

   {heading_row_start}<tr>{/heading_row_start}

   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
   {heading_title_cell}<th class="calendar_month" colspan="{colspan}">{heading}</th>{/heading_title_cell}

   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {cal_cell_content}{content}{/cal_cell_content}
   {cal_cell_content_today}{content}{/cal_cell_content_today}

   {cal_cell_no_content}<div class="no_date_data"><a href="javascript:;">{day}</a></div>{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="no_date_data"><a href="javascript:;">{day}</a></div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';

Calendar::initialize(array('template' => $template, 'show_next_prev'=>true, 'start_day'=>'monday'));

?>

<span id="currentMonth">{{$data['calendarMonth']}}</span><span id="currentYear">{{$data['calendarYear']}}</span>
<div id="request_calendar">
    {!!Calendar::generate($data['calendarYear'], $data['calendarMonth'], $data['requests'])!!}
</div>