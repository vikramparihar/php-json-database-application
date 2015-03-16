<?php
define('LAZER_DATA_PATH', realpath(dirname(__FILE__)).'/data/');
require_once '../vendor/autoload.php';
use Lazer\Classes\Database as Lazer;
$id = intval($_GET['id']);
$group = Lazer::table('group')->find($id);
?>

<form id="frmgrpupdate"  method="POST">
    <div class="response">
    </div>
    <div class="form-group" id="par-name">
        <small><b>Group name:</b></small>
        <input class="form-control input-sm" id="input-grp" type="text" name="group" value="<?php echo $group->name?>" required data-parsley-error-message="" data-parsley-errors-container="#par-name" data-parsley-class-handler="#par-name" >
        <input type="hidden" name="id" value="<?php echo $id?>">
        <br>
        <input type="hidden" name="groupupdate" value="1">
        <input class="btn- btn-block btn-sm" type="submit" id="btn-grpupdate" value="save" name="grpupdate">
    </div>
</form>


<script>
    $(document).ready(function (){
        $('#frmgrpupdate').parsley({
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
        
        
        $("#frmgrpupdate").submit(function (e){
            e.preventDefault();
            $.ajax({
                url: "ajaxcall/fetch.php",
                data: $(this).serialize(),
                type:"POST",
            }).done(function(res){
                $(".response").html(res);
                getGroup();
                populateSelect();
            });
        });
        
    });
</script>
