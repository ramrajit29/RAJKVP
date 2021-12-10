<?php
include 'logChecker.php';
?>
<h3>Add Product</h3>
<hr>
<style>
.bootbox-close-button{
    float:right !important;   
    border:0 !important; 
}
</style>
<script src="js/ajaxupload.js"></script>
<form id="prod_form" name="prod_form" method="post" autocomplete="off"> 
<div class="row">   
    <div class="col-md-6">
        <label>Product Name *</label><br>
        <input type="text" name="prod_name" class="form-control mandatory_sec"  />
    </div>
    <div class="col-md-6">
        <label>Price *</label><br>
        <input type="text" name="prod_price" class="form-control mandatory_sec"  />
    </div>
    <div class="col-md-6">
        <label>UPC Number *</label><br>
        <input type="text" class="form-control mandatory_sec" name="upc_num" />
    </div>
    <div class="col-md-6">
        <label>Status</label><br>
        <input type="text" class="form-control" name="prod_status"  />
    </div>
    <div class="col-md-6">
        <input type="hidden" id="prod_photo_path" name="prod_photo_path" />
        
        <label class="string optional grr_title" >Photo</label><div class="clear"></div>
        <div class="photo_upload_holder" id="prod_photo">
            <div class="photo_image_result" ><i class="fa fa-image"></i></div>
        </div> 
        <br>       
    </div>
</form>

<div class="col-md-12">
    <br>
    <input type="button" class="btn btn-dark" value="Submit" id="prod_submit_btn" onclick="insert_product();" />
</div>
<br>
<div class="col-md-12"><div id="action_status"></div</div>
</div>
<script>
$(document).ready(function(){
    upload_prod_photo();
});
function upload_prod_photo(){
	var button = $('#prod_photo');
	new AjaxUpload(button,{
		action: 'upload_photo.php', 
		name: 'post_image',
		method: 'post',
		onSubmit : function(file, ext){
			if (!(ext && /^(PNG|png|jpg|JPG|gif|GIF)$/.test(ext))){
				alert('Invalid file');
				return false;			}
			else{
				$('.photo_image_result').html('<i class="fa fa-spinner" aria-hidden="true"></i>');
			}
		},
		onComplete: function(file, response){
			$('.photo_image_result').html('');
			$('#prod_photo_path').val(response);
			$('.photo_upload_holder').css('background-image', 'url(' + response + ')');
		}
	});
}     
function insert_product(){
    var flag = 0;
    $('.mandatory_sec').each(function() {
        if($(this).val()==''){
            flag++;
            $(this).css('border-color','#FF0000');    
        }else{
            $(this).css('border-color','');    
        }
    });

    if(flag==0){
        $('#action_status').attr('class', 'alert alert-warning open');
        $('#action_status').html('<i class="icon-spin4 animate-spin"></i>&nbsp;Please wait...while submitting...');
        $('#prod_submit_btn').hide();
        var vals = $('#prod_form').serialize();
    
        $.post('insert_product.php', vals, function(data){
            var info = jQuery.parseJSON(data);
            if(info.success){
                $('#action_status').removeClass();
                $('#action_status').attr('class', 'alert alert-success open');
                $('#action_status').html(info.response);
                
                location.reload();
            }else{
                $('#action_status').removeClass();
                $('#action_status').attr('class', 'alert alert-danger open');
                $('#prod_submit_btn').show();
                $('#action_status').html(info.response);
            }
        });
    }
}
</script>
<style>    
.photo_upload_holder {
 	background-color: #f1f1f1;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    border-bottom: 1px solid #cccccc;
    float: left;
    font-size: 30px;
    line-height: 50px;
    margin-bottom: 5px;
    margin-right: 5px;
    text-align: center;
    width: 100px;
    cursor:pointer;
    padding: 25px 0;
    height: 80px;
}
</style>