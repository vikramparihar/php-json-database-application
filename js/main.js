
    $(document).ready(function (){
        getGroup();
        populateSelect();
        $("#dialog").dialog({
            autoOpen: false,
            modal: true
        });
        
        $('#frmgrpadd, #frmemailadd').parsley({
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
        
        $("#frmgrpadd").submit(function (e){
            e.preventDefault();
            $.ajax({
                url: "ajaxcall/fetch.php",
                type: 'POST',
                data: $(this).serialize()
            }).done(function(res){
                $(".grpres").html(res);
                getGroup();
                populateSelect();
                $("#frmgrpadd #input-grp").val('');
            });
        });
        $("#frmemailadd").submit(function (e){
            e.preventDefault();
            $.ajax({
                url: "ajaxcall/fetch.php",
                type: 'POST',
                data: $(this).serialize()
            }).done(function(res){
                $(".emailres").html(res);
                getGroup();
                $("#frmemailadd #input-grp, #frmemailadd #input-name, #frmemailadd #input-email").val('');
                
            });
        });
        
        
        $("body").on('click','.viewlist', function (){
            getEmail($(this).attr('tid'));
        });
        
        $("body").on('click','.delemail', function (e){
            e.preventDefault();
            var self = $(this);
            $("#dialog").dialog({
                buttons : {
                    "Confirm" : function() {
                    $(this).dialog("close");
                        deleteEmail(self.attr('data-id'));
                        self.parents('tr').first().hide('slow');
                },
                    "Cancel" : function() {
                      $(this).dialog("close");
                      return false;
                    }
                } 
            });
            $("#dialog").dialog("open");
            
        });
        $("body").on('click','.delgrp', function (e){
            e.preventDefault();
            var self = $(this);
            $("#dialog").dialog({
                buttons : {
                    "Confirm" : function() {
                    $(this).dialog("close");
                        deleteGroup(self.attr('data-id'));
                        self.parents('tr').first().hide('slow');
                },
                    "Cancel" : function() {
                      $(this).dialog("close");
                      return false;
                    }
                } 
            });
            $("#dialog").dialog("open");
        });
        
        $("body").on('click','.btn-update', function (e){
            var url = $(this).attr('data-url');
            $(".modal-grp-edit").load(url);
            
        });
        
        $(".modal .closemodal").on('click', function (){
           $("#myModal").modal('hide');
           
        });
        
        
    });
    
    var getGroup = function (){
        $.ajax({
           url: "ajaxcall/fetch.php",
           type: 'POST',
           data:{ fetchgrp:1}
        }).done(function (res){
            $(".loadgrp").html(res);
        });
    };
    
    var getEmail = function (id){
        $.ajax({
            url: "ajaxcall/fetch.php",
            type: 'POST',
            data:{fetchemail:id}
        }).done(function (res){
            $(".loademail").html(res);
        });
    };
    
    var deleteEmail = function (id){
        $.ajax({
            url: "ajaxcall/fetch.php",
            type: 'POST',
            data:{deleteemail:id}
        }).done(function (res){
        });
    };
    
    var deleteGroup = function (id){
        $.ajax({
            url: "ajaxcall/fetch.php",
            type: 'POST',
            data:{deletegroup:id}
        }).done(function (){
            getGroup();
            $(".loademail").html("");
        });
    };
    
    var populateSelect = function (){
        $.ajax({
            url: "ajaxcall/fetch.php",
            type: 'POST',
            data:{populateSelect:1}
        }).done(function (res){
            $("#select-grp").html(res);
        });
    };
    