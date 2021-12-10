<html>
    <head>
        <title>SAMPLE PROJECT</title>    
        <link href="css/style.css?v=<?=rand()?>" rel="stylesheet" type="text/css" />  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <script src="js/bootbox.js" type="text/javascript"></script>
		 
        <script src="js/login.js?v=<?=rand()?>"></script>  
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: sans-serif;
                background-image:  url('images/bg.jpg');
                background-size: cover;
                background-repeat: no-repeat;                
            }
        </style>
        
    </head>

    <body>
        <div class="login_panel">
            <div class="logo_img">
                <img src="https://www.freeiconspng.com/uploads/icons-login-23.png" height="130" />
            </div>
            <h2>Login to your Console</h2>
            
            <form method="post">
                <div class="field_box">
                    <input type="text" name="user_name_val" id="user_name_val" placeholder="Email" />
                </div>
                <div class="field_box">
                    <input type="password" id="user_pass_val" name="user_pass_val" placeholder="Password" />
                </div>
                <div class="field_box">
                    <input type="button" id="submit_btn" value="Sign in" onclick="login_func();" />
                </div>
                <div class="field_box">
                    <div id="login_status"></div>
                </div>
                
                <div class="field_box_link">
                    <a href="javascript:;" onclick="forgot_pass_func();">Forgot Password?</a>
                </div>
                <div class="field_box_link">
                    <a href="javascript:;" onclick="signup_func();">Don't have an account?</a>
                </div>
            </form>
        </div>
    </body>
</html>