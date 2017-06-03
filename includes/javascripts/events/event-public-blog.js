/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/05/13
 * Time: 21:55
 * To change this template use File | Settings | File Templates.
 */
/*jslint browser: true */
/*global document, $, SyntaxHighlighter, SOLEIL, addthis */


$(function () {
    'use strict';

    $("button#comment_button").button({
        icons: {
            primary: "ui-icon-comment"
        }
    }).click(function () {

        var $input_comment_name = $("#comment_name"),
            $input_comment_mail = $("#comment_mail"),
            $input_comment_website = $("#comment_website"),
            $input_comment_textarea = $("#comment_textarea"),
            $input_comment_passage_id = $("#comment_passage_id"),
            comment_name = $input_comment_name.val(),
            comment_mail = $input_comment_mail.val(),
            comment_website = $input_comment_website.val(),
            comment_textarea = $input_comment_textarea.val(),
            comment_passage_id = $input_comment_passage_id.val(),
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
            $input_comment_mail.css("border", "1px solid red");
            $("span#error_mail").html("Please enter a valid email address.");
        } else {

            clear_css();
            $.ajax({
                url: SOLEIL.Global.hostName + "/blog/commentblog",
                type: 'POST',
                dataType: "JSON",
                data: {
                    comment_name: comment_name,
                    comment_mail: comment_mail,
                    comment_website: comment_website,
                    comment_textarea: comment_textarea,
                    comment_passage_id: comment_passage_id
                },
                success: function (success) {
                    if (success) {
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


    $("span#reply_comment").click(function () {
        var original_name = $(this).attr("data-name");
        $("textarea[name='comment_textarea']").val('Reply to ' + original_name + '\n\r').focus();
        $('html, body').animate({
            scrollTop: $("div#leave_comment").offset().top
        }, 'fast');
    });


    //Syntax Highlighter
    /*TODO: Autoloader doesn't work for IE10, very strange. Only works after page refreshed.*/

    /*
     path = function () {
     var result = [], i;
     for (i = 0; i < arguments.length; i += 1) {
     result.push(arguments[i].replace('@', SOLEIL.Global.baseUrl + 'includes/syntaxhighlighter/scripts/'));
     }
     return result;
     };

     SyntaxHighlighter.autoloader.apply(null, path(
     'applescript            @shBrushAppleScript.js',
     'actionscript3 as3      @shBrushAS3.js',
     'bash shell             @shBrushBash.js',
     'coldfusion cf          @shBrushColdFusion.js',
     'cpp c                  @shBrushCpp.js',
     'c# c-sharp csharp      @shBrushCSharp.js',
     'css                    @shBrushCss.js',
     'delphi pascal          @shBrushDelphi.js',
     'diff patch pas         @shBrushDiff.js',
     'erl erlang             @shBrushErlang.js',
     'groovy                 @shBrushGroovy.js',
     'java                   @shBrushJava.js',
     'jfx javafx             @shBrushJavaFX.js',
     'js jscript javascript  @shBrushJScript.js',
     'perl pl                @shBrushPerl.js',
     'php                    @shBrushPhp.js',
     'text plain             @shBrushPlain.js',
     'py python              @shBrushPython.js',
     'ruby rails ror rb      @shBrushRuby.js',
     'sass scss              @shBrushSass.js',
     'scala                  @shBrushScala.js',
     'sql                    @shBrushSql.js',
     'vb vbnet               @shBrushVb.js',
     'xml xhtml xslt html    @shBrushXml.js'
     ));
     */

    //BloggerMode use the <br> as the break line, not \n.
    SyntaxHighlighter.config.bloggerMode = true;
    SyntaxHighlighter.all();


    //Addthis plugin
    addthis.layers({
        'theme': 'gray',
        'share': {
            'position': 'left',
            'services': 'facebook,twitter,google_plusone_share,email,print,more'
            //'numPreferredServices' : 5
        }
    });
});