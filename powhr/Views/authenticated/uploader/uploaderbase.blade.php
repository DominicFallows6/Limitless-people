<script src="/js/uploader/dropzone.min.js"></script>
<link rel="stylesheet" href="/css/uploader/dropzone.min.css"/>

<?php
//this creates any select dropdowns and their options for use in the upload template
//can be any set of elements - all HTML inside "selectOptions" tag will be duplicated
?>
<div id="selectOptions" style="display: none">
    <?php
    foreach ($data['uploads']['options'] AS $dropKey => $dropValue) {
    ?>
    <div class="drop-option-upload-option">
        <p><?=$dropValue['label']?></p>
        <select class="<?=$dropKey?> dynamic_option" data-realname="<?=$dropKey?>">
            <?php
            foreach ($dropValue['values'] AS $optionKey => $optionValue) {
            ?>
            <option value="<?=$optionKey?>"><?=$optionValue?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <?php
    }
    ?>
</div>

<script type="text/javascript">

    function clearQueue() {
        $('.dz-preview').each(function () {
            $(this).slideUp(1000, function () {
                $(this.remove());
            });
        });
        $('p#upload-instruction').removeClass('error');
        $('#startProcess').removeAttr('disabled');
        $('.dropzone.dz-started .dz-message').show();
    }

    Dropzone.autoDiscover = false;
    var selectRuns = 0;

    //used for creating unique ids
    var selectMultiplier = $('#selectOptions select').length;

    $(document).ready(function () {

        var myDropzone = new Dropzone('#<?=$data['uploads']['id']?>', {
            autoProcessQueue: false
        });

        //this little work around sets all top process once the first is started
        myDropzone.on("success", function () {
            myDropzone.options.autoProcessQueue = true;
        });

        //this essentially works like a loop
        myDropzone.on("addedfile", function (file) {

            var newElement = $(file.previewElement);
            var typeClass = file.type;

            //this is just so that we can add a usable name to apply to the div class
            typeClass = typeClass.replace('/', '');
            typeClass = typeClass.replace('.', '');

            //set individual element data and ids and names for validation and pass through
            newElement.children('.dz-image').addClass(typeClass);
            newElement.append($('#selectOptions').html());

            //this is done so we can correllate image with drop downs as any element present is sent form
            //could be done using internal memory too
            newElement.append($('<input type="hidden" class="upload_id" name= "upload_id_' + selectMultiplier + '" id="upload_id_' + selectMultiplier + '" value="' + selectMultiplier + '"/> '));

            //each select object needs an id and name
            //will need to alter when text inputs are used - as will above for upload id
            newElement.children('.drop-option-upload-option').children('select').each(function (i, e) {

                var thisSelect = $(e);
                var dropName = thisSelect.data('realname');
                thisSelect.attr('name', dropName + '_' + selectMultiplier);
                thisSelect.attr('id', dropName + '_' + selectMultiplier);

            });

            //increment upload iterator
            selectMultiplier++;

        });

        //clears a queue once its been completed
        myDropzone.on('queuecomplete', function () {
            myDropzone.options.autoProcessQueue = false;
            setTimeout(clearQueue, 5000);
        });

        myDropzone.on("sending", function (file, xhr, formData) {

            //tell the receiving app to know which post data to use
            var newElement = $(file.previewElement);
            var uploadID = newElement.children('.upload_id').val();

            formData.append("upload_id", uploadID);

        });

        $('#startProcess').on('click', function () {

            //adds in javascript validation determined by calling part of app
            <?php
            foreach($data['uploads']['options'] AS $dropKey => $dropValue) {
            ?>
            $.validator.addClassRules('<?=$dropKey?>', {
                <?php
                foreach ($dropValue['validation'] AS $keyValid => $valueValid) {
                    echo $valueValid;
                }
                ?>
            })
            <?php
            }
            ?>

            <?php
            //calls the validation on the form id provided by the PHP
            ?>
            $('#<?=$data['uploads']['id']?>').validate({
                debug: true
            });

            if ($('#<?=$data['uploads']['id']?>').valid() && $('.dz-preview').length > 0) {
                $(this).attr('disabled', 'disabled');
                myDropzone.processQueue();
            } else {
                $('p#upload-instruction').addClass('error');
                return false;
            }

        });

    })

</script>

{!!Form::open(
    array(
        'url'=>$data['uploads']['url'],
        'class'=>$data['uploads']['classes'],
        'id' => $data['uploads']['id'],
        'name' => $data['uploads']['name']
    )
)!!}
{!!Form::close()!!}

<button id="startProcess" class="btn btn-primary">
    Process Queue
</button>



