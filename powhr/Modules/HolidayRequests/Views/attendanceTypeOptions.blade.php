<style>
    #attendance_type_drop_options_container {
        display: none;
    }
</style>

<script type="text/javascript">
    //make available to entire page
    var attendance_type_options = <?php echo $data['type_options'];?>
</script>
<div id="attendance_type_drop_options_container">
    <select id="attendance_types" name="attendance_type"></select>
</div>