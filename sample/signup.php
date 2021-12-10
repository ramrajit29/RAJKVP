<h3>Register</h3>
<hr>
<style>
.bootbox-close-button{
    float:right !important;   
    border:0 !important; 
}
</style>

<form id="signup_form" name="signup_form" method="post" autocomplete="off">    
    <div class="col-md-6">
        <label>Name *</label><br>
        <input type="text" name="user_name" class="form-control mandatory_sec"  />
    </div>
    <div class="col-md-6">
        <label>Email *</label><br>
        <input type="text" name="user_email" class="form-control mandatory_sec"  />
    </div>
    <div class="col-md-6">
        <label>Phone *</label><br>
        <input type="text" class="form-control mandatory_sec" name="user_phone" />
    </div>
    <div class="col-md-6">
        <label>Desired password *</label><br>
        <input type="password" class="form-control mandatory_sec" name="user_desire_pwd"  />
    </div>
</form>
<div class="col-md-12">
    <br>
    <input type="button" class="btn btn-dark" value="Submit" id="signup_submit_btn" onclick="submit_user();" />
</div>
<br>
<div class="col-md-12"><div id="action_status"></div</div>


<script>
function submit_user(){
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
        $('#signup_submit_btn').hide();
        var vals = $('#signup_form').serialize();
    
        $.post('insert_user.php', vals, function(data){
            var info = jQuery.parseJSON(data);
            if(info.success){
                $('#action_status').removeClass();
                $('#action_status').attr('class', 'alert alert-success open');
                $('#action_status').html(info.response);
                setTimeout(function(){ location.reload(); }, 3000);                
            }else{
                $('#signup_submit_btn').show();
                $('#action_status').removeClass();
                $('#action_status').attr('class', 'alert alert-danger open');
                $('#action_status').html(info.response);
            }
        });
    }
}
</script>