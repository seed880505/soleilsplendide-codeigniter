<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Log In</title>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url("includes/css/jquery-ui/dot-luv/jquery-ui.min.css"); ?>"/>
    <script type="text/javascript" src="<?php echo base_url("includes/javascripts/jquery/jquery.min.js"); ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url("includes/javascripts/jquery/jquery-ui.min.js"); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url("includes/javascripts/events/event-login.js"); ?>"></script>

</head>
<body>

<div id="container_log" class="container_log_style">
    <div class="title_text_log">Log In
        <span id="forget_pass">forget password?</span>
    </div>
    <div id="show_error_log" class="show_error_log_style"></div>
    <div class="form_login_style">
        <form id="form_login" action="<?php echo site_url("auth/login"); ?>" method="post">
            <table>
                <tbody>
                <tr>
                    <td><label for="user_email">E-mail:</label></td>
                    <td><input type="text" name="useremail" id="user_email"></td>
                </tr>
                <tr>
                    <td><label for="user_pass">Password:</label></td>
                    <td><input type="password" name="userpass" id="user_pass"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <button type="button" id="form_submit_log">Log In</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>


<div id="container_log_forget" class="container_log_style SS_hidden">
    <div class="title_text_log">Forget password
        <span id="return_login">Return login?</span>
    </div>
    <div id="show_error_log_forget" class="show_error_log_style"></div>
    <div class="form_login_style">
        <form id="form_login_forget" action="<?php echo site_url("auth/resetpassword"); ?>" method="post">
            <table>
                <tbody>
                <tr>
                    <td><label for="user_email_forget">E-mail:</label></td>
                    <td><input type="text" name="useremail_forget" id="user_email_forget"></td>
                </tr>
                <tr class="SS_invisible">
                    <td><label>Password:</label></td>
                    <td><input type="password"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <button type="button" id="form_submit_log_forget">Send email</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>


</body>
</html>