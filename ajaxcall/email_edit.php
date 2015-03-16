<?php
define('LAZER_DATA_PATH', realpath(dirname(__FILE__)).'/data/');
require_once '../vendor/autoload.php';
use Lazer\Classes\Database as Lazer;
$id= intval($_GET['id']);
$email = Lazer::table('email')->limit(1)->find($id);
$group_result = Lazer::table('group')->findAll();
?>


<form id="frmemailupdate">
    <div class="response">
    </div>
    <div class="form-group">
        <small><b>Group name:</b></small>
        <select class="form-control input-sm" id="select-grp1" name="group_id">
            <?php foreach ($group_result as $re):?>
            <option value="<?php echo $re->id?>"><?php echo $re->name?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group" id="par-name">
        <small><b>Person Name:</b></small>
        <input class="form-control input-sm" id="input-name" type="text" name="name" value="<?php echo $email->name ?>" required data-parsley-error-message="" data-parsley-errors-container="#par-name" data-parsley-class-handler="#par-name">
    </div>
    <div class="form-group" id="par-email">
        <small><b>Email ID:</b></small>
        <input class="form-control input-sm" id="input-email" type="email" name="email" value="<?php echo $email->email ?>" required data-parsley-error-message="" data-parsley-errors-container="#par-email" data-parsley-class-handler="#par-email">
    </div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="recordupdate" value="1">
        <input class="btn- btn-block btn-sm" type="submit" id="emailupdate" value="save" name="emailupdate">
</form>

<script>
    $(document).ready(function (){
        $("#select-grp1").val(<?php echo $email->group_id ?>);
        
        $('#frmemailupdate').parsley({
            successClass: 'has-success',
            errorClass: 'has-error',
            uiEnabled: true,
            errors: {
            classHandler: function(el) {
              return el.parent();
            },
            // Set these to empty to make sure the default Parsley elements are not rendered
            errorsWrapper: '',
            errorElem: ''
            },
            errorsWrapper: '',
            errorElem: ''
        });
        
        
        $("#frmemailupdate").submit(function (e){
            e.preventDefault();
            $.ajax({
                url: "ajaxcall/fetch.php",
                data: $(this).serialize(),
                type:"POST"
            }).done(function(res){
                $(".response").html(res);
                window.location.reload();
            });
        });
        
    });
</script>
