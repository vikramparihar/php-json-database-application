<?php
//fetch.php
//error_reporting(0);
define('LAZER_DATA_PATH', realpath(dirname(__FILE__)).'/data/');
require_once '../vendor/autoload.php';
use Lazer\Classes\Database as Lazer;

//if table does not exists create
try{
\Lazer\Classes\Helpers\Validate::table('email')->exists();
} catch(\Lazer\Classes\LazerException $e){
Lazer::create('email', array(
    'name' => 'string',
    'email' => 'string',
    'group_id' => 'integer'
));
}

//if table does not exists create

try{
\Lazer\Classes\Helpers\Validate::table('group')->exists();
}catch(\Lazer\Classes\LazerException $e){
 Lazer::create('group', array(
    'name' => 'string',
));   
}
$email = Lazer::table('email');
$group = Lazer::table('group');



//Fetch all groups
if(isset($_POST['fetchgrp'])): ?>
<table class="table table-hover">
    <tr><th>Name</th><th>Action</th></tr>
    <?php $group_result = Lazer::table('group')->findAll(); ?>
    <?php if(count($group_result)> 0){ ?>
    <?php foreach ($group_result as $grp): ?>
    <tr><td  class="viewlist" tid="<?php echo $grp->id ?>"><?php echo $grp->name ?></td>
        <td><a href="#" data-url="ajaxcall/group_edit.php?id=<?php echo $grp->id?>" class="btn-update" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;&nbsp;
            &nbsp;<a href="#" class="delgrp" data-id="<?php echo $grp->id  ?>"><i class="fa fa-times"></i></a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php }else{echo'No Record Found';}?>
</table>
<?php endif;


//Fetch all email relates to particular group
if(isset($_POST['fetchemail'])):?>

<?php $id = $_POST['fetchemail'] ;
      $email_result = Lazer::table('email')->where('group_id', '=', $id)->findAll();
//            $email_result = Lazer::table('email')->findAll();
//      var_dump($email_result);
?>
  <table class="table table-hover">
    <tr><th>Name</th><th>Email</th><th>Action</th></tr>
    <?php if(count($email_result)> 0){ ?>
    <?php foreach ($email_result as $em): ?>
    <tr><td><?php echo $em->name ?></td><td><?php echo $em->email ?></td>
        <td><a href="#" data-url="ajaxcall/email_edit.php?id=<?php echo $em->id?>" class="btn-update" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;&nbsp;
            &nbsp;<a href="#" class="delemail" data-id="<?php echo $em->id ?>"><i class="fa fa-times"></i></a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php }else{echo 'No Record Found';}?>
</table>
<?php endif;

//Delete email
if(isset($_POST['deleteemail'])):
    $id = $_POST['deleteemail'] ;
    Lazer::table('email')->find($id)->delete();

endif;

//Delete Group
if(isset($_POST['deletegroup'])):
    $id = $_POST['deletegroup'] ;
    Lazer::table('group')->find($id)->delete(); 
    //check whether email are exists or not to related group
    if(emailExists($id)){
        Lazer::table('email')->where('group_id', '=', $id)->find()->delete();
    }
endif;

//Update email record
if(isset($_POST['recordupdate'])): 
$id= $_POST['id'];
$grp_id = intval($_POST['group_id']);
$name = $_POST['name'];
$email_id = $_POST['email'];
    $row = Lazer::table('email')->find($id);
    $row->name = $name;
    $row->email = $email_id;
    $row->group_id = $grp_id;
    $row->save();
    echo'<div class="alert alert-success">Record updated successfully</div>';
endif;

//Update group record
if(isset($_POST['groupupdate'])): 
    $id= $_POST['id'];
    $name = $_POST['group'];
    $row = Lazer::table('group')->find($id);
    $row->name = $name;
    $row->save();
    echo'<div class="alert alert-success">Record updated successfully</div>';
endif;

//Add new group
if(isset($_POST['grpadd'])):
    $name =  (string)trim($_POST['group']);
    if($name){
    $group->name = $name;
    $group->save();
    echo '<div class="alert alert-success text-center" style="padding: 5px">Record Added Successfully</div>';
    }
    else{
        echo '<div class="alert alert-warning text-center" style="padding: 5px">Invalid group</div>';
    }
endif;

//Add new email Record
if(isset($_POST['emailadd'])):
$group = intval($_POST['group_id']);
$name = $_POST['name'];
$email_id = $_POST['email'];
if(!empty($group)){
        if(!empty($name)){
            if(!empty($email)){
                    $email->name = $name;
                    $email->email = $email_id;
                    $email->group_id = $group;
                    $email->save();
                    echo '<div class="alert alert-success text-center" style="padding: 5px">One record added Successfully</div>';
                }
            else{
                echo '<div class="alert alert-warning text-center" style="padding: 5px">Invalid Email</div>';
            }
        }
        else{
            echo '<div class="alert alert-warning text-center" style="padding: 5px">Invalid user name</div>';
        }
}
else{
    echo '<div class="alert alert-warning text-center" style="padding: 5px">Invalid group</div>';
}
endif;

//Populate select box
if(isset($_POST['populateSelect'])):    
$group_result = Lazer::table('group')->findAll();  ?>
<option value="">Select</option>
<?php foreach ($group_result as $re):?>
    <option value="<?php echo $re->id?>"><?php echo $re->name?></option>
<?php endforeach;
endif;

//Fetch recipients email from relared group
if(isset($_GET['fetchRecipients'])):
    $id = $_GET['fetchRecipients'] ;
    $email_result = Lazer::table('email')->where('group_id', '=', $id)->findAll();
    $emails = array();
    foreach ($email_result as $em){
        $emails[] = $em->email;
    }
    echo implode(',', $emails);
endif;


//Function for check whether email record exists or not for particular record
function emailExists($id){
  $row = Lazer::table('email')->where('group_id', '=', $id)->findAll()->count();
  return $row;
}


exit;
?>
