/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 08/06/13
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
 */
/*jslint browser: true, regexp: true */
/*global document, $, SOLEIL */

$(function () {
    "use strict";

    var $show_error_log = $("#show_error_log"),
        $user_email = $("#user_email"),
        $user_pass = $("#user_pass"),
        $show_error_log_forget = $("#show_error_log_forget"),
        $user_email_forget = $("#user_email_forget");


    //Link to forget page
    $("#forget_pass").click(function () {
        $("#container_log").fadeOut("fast", function () {
            $("#container_log_forget").fadeIn("slow");
        });
    });


    //Login button
    $("#form_submit_log").button({
        icons: {
            primary: "ui-icon-check"
        }
    }).click(function () {

        var emailAddressVal = $("input#user_email").val(),
            userPassword = $("input#user_pass").val(),
            cssObj = {
                "background-color": "#FFDCD7",
                "border": "1px solid red"
            },
            cssClear = {
                "background-color": "",
                "border": ""
            },
            html_email = "&bull;&nbsp;Please input an email.",
            html_email_valid = "&bull;&nbsp;Please input a valid email.",
            html_password = "&bull;&nbsp;Please input a password.",
            html_password_length = "&bull;&nbsp;Your password should be more than 6 characters.",
            html_email_exist = "&bull;&nbsp;The Email address not exists.",
            show_speed = "fast";

        if (emailAddressVal === '') {

            $show_error_log.html(html_email);
            $show_error_log.show(show_speed);
            $user_email.css(cssObj);
            $user_email.focus();
        } else if (!SOLEIL.Global.emailReg.test(emailAddressVal)) {

            $show_error_log.html(html_email_valid);
            $show_error_log.show(show_speed);
            $user_email.css(cssObj);
            $user_email.focus();
        } else if (userPassword === '') {

            $user_email.css(cssClear);
            $show_error_log.html(html_password);
            $show_error_log.show(show_speed);
            $user_pass.css(cssObj);
            $user_pass.focus();
        } else if (userPassword.length < 6) {

            $show_error_log.html(html_password_length);
            $show_error_log.show(show_speed);
            $user_pass.css(cssObj);
            $user_pass.focus();
        } else {

            $.ajax({
                url: SOLEIL.Global.hostName + "/auth/checkEmailExist",
                type: 'POST',
                dataType: "JSON",
                data: {
                    email: emailAddressVal
                },
                success: function (success) {
                    if (success) {
                        $("form#form_login").submit();
                    }
                    else {
                        $show_error_log.html(html_email_exist);
                        $show_error_log.show(show_speed);
                        $user_email.css(cssObj);
                        $user_email.focus();
                    }
                },
                error: function () {
                    window.alert('Failed!');
                }
            });
        }
    });


    //Return to login page
    $("#return_login").click(function () {
        $("#container_log_forget").fadeOut("fast", function () {
            $("#container_log").fadeIn("slow");
        });
    });


    //Send email to reset password
    $("button#form_submit_log_forget").button({
        icons: {
            primary: "ui-icon-mail-closed"
        }
    }).click(function () {

        var emailAddressVal = $("input#user_email_forget").val(),
            cssObj = {
                "background-color": "#FFDCD7",
                "border": "1px solid red"
            },

            html_email = "&bull;&nbsp;Please input an email.",
            html_email_valid = "&bull;&nbsp;Please input a valid email.",
            html_email_exist = "&bull;&nbsp;The Email address not exists.",
            show_speed = "fast";

        if (emailAddressVal === '') {

            $show_error_log_forget.html(html_email);
            $show_error_log_forget.show(show_speed);
            $user_email_forget.css(cssObj);
            $user_email_forget.focus();
        } else if (!SOLEIL.Global.emailReg.test(emailAddressVal)) {

            $show_error_log_forget.html(html_email_valid);
            $show_error_log_forget.show(show_speed);
            $user_email_forget.css(cssObj);
            $user_email_forget.focus();
        } else {

            $.ajax({
                url: SOLEIL.Global.hostName + "/auth/checkEmailExist",
                type: 'POST',
                dataType: "JSON",
                data: {
                    email: emailAddressVal
                },
                success: function (success) {
                    if (success) {
                        $("form#form_login_forget").submit();
                    }
                    else {
                        $show_error_log_forget.html(html_email_exist);
                        $show_error_log_forget.show(show_speed);
                        $user_email_forget.css(cssObj);
                        $user_email_forget.focus();
                    }
                },
                error: function () {
                    window.alert('Failed!');
                }
            });
        }
    });
    /*---------------END---------------FOR FORGET PASSWORD*/
});