<h3>Forgot Password</h3>
<hr>
<style>
.bootbox-close-button{
    float:right !important;   
    border:0 !important; 
}
</style>

<div class="col-md-6">Email</div>
<div class="col-md-6">
    <input type="text" class="form-control" id="email_id_val" name="email_id_val" />
</div>

<div class="col-md-12">
    <br>
    <input type="button" class="btn btn-dark" id="forgot_btn" value="Submit" onclick="reset_password();" />
</div>
<br>
<div class="col-md-12"><div id="action_status"></div</div>
<script>
function reset_password(){
    var flag = 0;
    if($('#email_id_val').val()==''){
        flag++;
        $('#email_id_val').css('border-color','#FF0000');    
    }else{
        $('#email_id_val').css('border-color','');    
    }

    if(flag==0){
        $('#action_status').attr('class', 'alert alert-warning open');
        $('#action_status').html('<i class="icon-spin4 animate-spin"></i>&nbsp;Please wait...while submitting...');
        $('#forgot_btn').hide();
    
        $.post('reset_password.php', {email_id:$('#email_id_val').val()}, function(data){
            var info = jQuery.parseJSON(data);
            if(info.success){
                $('#action_status').removeClass();
                $('#action_status').attr('class', 'alert alert-success open');
                $('#action_status').html(info.response);                
                ///location.reload();
            }else{
                $('#action_status').removeClass();
                $('#action_status').attr('class', 'alert alert-danger open');
                $('#forgot_btn').show();
                $('#action_status').html(info.response);
            }
        });
    }
}
</script>
