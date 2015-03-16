<!doctype html>
<html class="no-js" lang="en" itemscope itemtype="http://schema.org/Movie">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, max-scale=1.0"/>
    <title>Nike Emailer</title>
    <link rel="stylesheet" type="text/css" href="../css/pure-min.css">
    <link rel="stylesheet" type="text/css" href="../css/grids-responsive-min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />

    <script src="../js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/parsley.js/2.0.4/parsley.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
</head>
<body>
<div class="header">
    <img src="../images/email.png" width="48"/> Nike Emailer
    <div class="menu"><a class="button-menu pure-button" href="../">View Templates</a></div>
</div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <h3>Groups</h3>    
                <hr>
                <div class="table-responsive loadgrp">
                    <table class="table table-hover">
                        <tr><th>Name</th><th>Action</th></tr>
                        <tr><td>Group 1</td><td><a href="#"><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;&nbsp;
                                &nbsp;<a href="#"><i class="fa fa-times"></i></a></td></tr>
                    </table>
                </div>
            </div>
            
            <div class="col-md-6">
                <h3>Email</h3>    
                <hr>
                <div class="table-responsive loademail">
                    <h4 class="text-info">Choose a group to see email list</h4>
                </div>
            </div>
            
            
            <div class="col-md-4">
                <h3>Actions</h3>    
                <hr>
                <form id="frmgrpadd">
                    <h3>Add Group</h3>
                    <div class="grpres dismiss"></div>
                    <div class="form-group" id="par-group">
                        <small><b>Group name:</b></small>
                        <input class="form-control input-sm" id="input-grp" type="text" name="group" required data-parsley-error-message="" data-parsley-errors-container="#par-group" data-parsley-class-handler="#par-group">
                        <br>
                        <input type="hidden" name="grpadd" value="1">
                        <input class="btn- btn-block btn-sm" type="submit" id="btn-grpadd" value="submit" name="grpadd">
                    </div>
                </form>
                
                
                <form id="frmemailadd" method="POST">
                    <h3>Add Email</h3>
                    <div class="emailres dismiss"></div>
                    <div class="form-group" id="par-select">
                        <small><b>Group name:</b></small>
                        <select class="form-control input-sm" id="select-grp" name="group_id" required data-parsley-error-message="" data-parsley-errors-container="#par-select" data-parsley-class-handler="#par-select">
                            <option value="">select</option>
                        </select>
                    </div>
                    <div class="form-group" id="par-pname">
                        <small><b>Person Name:</b></small>
                        <input class="form-control input-sm" id="input-name" type="text" name="name" required data-parsley-error-message="" data-parsley-errors-container="#par-pname" data-parsley-class-handler="#par-pname">
                    </div>
                    <div class="form-group" id="par-emailid">
                        <small><b>Email ID:</b></small>
                        <input class="form-control input-sm" id="input-email" type="email" name="email" required data-parsley-error-message="" data-parsley-errors-container="#par-emailid" data-parsley-class-handler="#par-emailid">
                    </div>
                    <input type="hidden" name="emailadd" value="1">
                        <input class="btn- btn-block btn-sm" type="submit" id="btn-emailadd" value="submit" name="emailadd">
                    
                </form>
            </div>
        </div>
        
    </div>
    
    
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit record</h4>
      </div>
      <div class="modal-body modal-grp-edit">
        
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
    
<!--jquery confirm box-->    
<a class="confirmLink" href="#"></a>
<div id="dialog" title="Confirmation Required">
  Are you sure to delete?
</div>
    
<script src="js/main.js"></script>
    
</body>