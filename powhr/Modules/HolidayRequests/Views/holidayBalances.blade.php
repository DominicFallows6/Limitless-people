<div class="row">
    <div class="col-lg-6 col-md-6 leave-box">

        <h3>Leave Entitlement for {{$data['calendar_year']}} <input type="hidden" name="calendar_year_choice" id="calendar_year_choice" value="{{$data['calendar_year']}}"/></h3>
        <p>Annual Entitlement: <span id="default_days_leave">{{$data['holidayBalances']->default_days_leave}}</span>

            <?php
            if ($days = Auth::user()->bonus_days > 0) {
                ?>
                <br />Bonus Days: {{$data['holidayBalances']->bonus_days}} <i class="fa fa-question-circle" aria-hidden="true" title="These are for long service etc."></i>
                <?php
            } elseif ($days = Auth::user()->bonus_days < 0) {
                ?>
                <br />Leave Adjustment: {{$data['holidayBalances']->bonus_days}} <i class="fa fa-question-circle" aria-hidden="true" title="This could be from a late start in a calendar year or if you work a reduced number of days in a week"></i>
                <?php
            }

            if ($days = Auth::user()->bonus_days != 0) {
                ?>
                <br />Total Adjusted Leave: <span id="total_adjusted_leave">{{$data['holidayBalances']->total_leave}}</span>
                <?php
            }
            ?>

        </p>

    </div>
    <div class="col-lg-6 col-md-6 leave-box">
        <h3 style="margin-bottom:12px">Authorised holidays for {{$data['calendar_year']}}</h3>
        <p>Leave Authorised: <span id="authorised_leave">{{$data['holidayBalances']->authorised_days}}</span>
            <br />Remaining Leave: <span id="remaining_leave">{{$data['holidayBalances']->balance}}</span>
            <br />Requested Leave: <span id="requested_leave"><?php echo $data['holidayBalances']->awaiting_days != 0 ? $data['holidayBalances']->awaiting_days : 0; ?></span>
    </div>
    <div class="clearfix"></div>
</div>