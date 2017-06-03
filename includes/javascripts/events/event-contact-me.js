/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/05/13
 * Time: 21:45
 * To change this template use File | Settings | File Templates.
 */
/*jslint browser: true */
/*global document, $, SOLEIL */

$(function () {
    'use strict';

    //Slick carousel
    $('#contact-me-slider').slick({
        autoplay: true,
        slide: 'div',
        dots: true,
        accessibility: false,
        arrows: false,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });

    //submit button
    $("button#comment_button").button({
        icons: {
            primary: "ui-icon-mail-closed"
        }
    }).click(function () {

        var $input_comment_name = $("#comment_name"),
            $input_comment_mail = $("#comment_mail"),
            $input_comment_website = $("#comment_website"),
            $input_comment_textarea = $("#comment_textarea"),

            comment_name = $input_comment_name.val(),
            comment_mail = $input_comment_mail.val(),
            comment_website = $input_comment_website.val(),
            comment_textarea = $input_comment_textarea.val(),
            clear_css;

        clear_css = function () {
            $input_comment_name.css("border", "none");
            $input_comment_mail.css("border", "none");
            $input_comment_textarea.css("border", "none");
            $("span.error").html("");
        };

        if (comment_name === '' || comment_mail === '' || comment_textarea === '') {

            clear_css();
            $input_comment_name.css("border", "1px solid red");
            $input_comment_mail.css("border", "1px solid red");
            $input_comment_textarea.css("border", "1px solid red");
            $("span.error").html("This field is required.");
        } else if (!SOLEIL.Global.emailReg.test(comment_mail)) {

            clear_css();
            $input_comment_name.css("border", "1px solid red");
            $("span#error_mail").html("Please enter a valid email address.");
        } else {

            clear_css();

            $.ajax({
                url: SOLEIL.Global.hostName + "/contact/index",
                type: 'POST',
                dataType: "JSON",
                data: {
                    comment_name: comment_name,
                    comment_mail: comment_mail,
                    comment_website: comment_website,
                    comment_textarea: comment_textarea
                },
                success: function (success) {
                    if (success) {
                        window.alert('Success!');
                        location.reload();
                    } else {
                        window.alert('Failed!');
                    }
                },
                error: function () {
                    window.alert('Failed!');
                }
            });
        }
    });
});

