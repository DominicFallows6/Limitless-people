<h4>Information about this request</h4>

<div class="hr_data_label">
    Requested Type
</div>
<div class="hr_data_value">
    <?=$data->holiday_request_type_name?>
</div>
<div class="clearer"></div>

<div class="hr_data_label">
    Requested Date
</div>
<div class="hr_data_value">
    <?=$data->formatted_request_date?>
</div>
<div class="clearer"></div>

<div class="hr_data_label">
    Duration
</div>
<div class="hr_data_value">
    <?php
    if ($data->duration == 1.00) {
        ?>
        Full Day
        <?php
    } else {
        ?>
        Half Day - <?=strtoupper($data->period)?>
        <?php
    }
    ?>
</div>
<div class="clearer"></div>

<div class="hr_data_label">
    Counts as Leave
</div>
<div class="hr_data_value">
    <?php echo $data->counts_as_leave == 1 ? 'Yes':'No'?>
</div>
<div class="clearer"></div>

<div class="hr_data_label">
    Requires Approval
</div>
<div class="hr_data_value">
    <?php echo $data->needs_approval == 1 ? 'Yes':'No'?>
</div>
<div class="clearer"></div>

<?php
if (!empty($data->authorised_by)) {
    ?>
    <div class="hr_data_label">
        Authorised By
    </div>
    <div class="hr_data_value">
        <?=$data->superior_name?><br /><div class="formatted_creation_date">On <?=$data->formatted_creation_date?></div>
    </div>
    <div class="clearer"></div>
    <?php
}
?>

<div class="hr_data_label">
    Status
</div>

<div class="hr_data_value">

    <?php

    if ($data->needs_approval == 0) {
        echo 'Request self authorised';
    } elseif ($data->authorised_by == 0) {
        echo 'Request awaiting authorisation';
    } elseif ($data->authorised_by == -1) {
        echo 'Request not authorised';
    } else {
        echo 'Request authorised';
    }
    ?>

</div>
<div class="clearer"></div>

<?php
if ($data->canDelete == 1) {
    ?>
    <span id="delete_holiday_request_id"><?=$data->request_id?></span>
    <p><a href="javascript:;" id="delete_holiday_request" class="btn btn-primary">Cancel Request</a></p>
    <?php
}
?>


