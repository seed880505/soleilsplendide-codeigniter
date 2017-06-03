/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/05/13
 * Time: 21:52
 * To change this template use File | Settings | File Templates.
 */

/*jslint browser: true */
/*global document, $, tinyMCE, SOLEIL*/

$(function () {
    'use strict';

    //Text editor
    tinyMCE.init({
        // General options
        height: 700,
        selector: "#blog_content",
        convert_fonts_to_spans: true,
        element_format: "html",
        entity_encoding: "named",
        theme: "modern",
        browser_spellcheck: true,
        nonbreaking_force_tab: true,
        plugin_insertdate_dateFormat: "%Y-%m-%d",
        plugin_insertdate_timeFormat: "%H:%M:%S",
        fontsize_formats: "16px 18px 20px 22px 24px 26px 28px 30px",
        image_advtab: true,
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste textcolor"
        ],
        toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        templates: [
            {title: 'JavaScript', content: '<pre class="brush: js; gutter: true">---JS code here---</pre>'},
            {title: 'HTML', content: '<pre class="brush: html; gutter: true">---HTML code here---</pre>'},
            {title: 'CSS', content: '<pre class="brush: css; gutter: true">---CSS code here---</pre>'}
        ],

        //Inject the blog data
        setup: function (editor) {
            editor.on('init', function (e) {
                if (SOLEIL.Global.blogContent !== '') {
                    e.target.setContent(SOLEIL.Global.blogContent);
                }
            });
        }
    });


    //JQUERY UI TABS
    $("#new_blog_tabs").tabs();


    //JQUERY BUTTON
    $(".new_blog_button").button().click(function (e) {
        e.preventDefault();

        var type = $(this).data('type'), blogId = $('#blog_id').data('id'), url, data, redirect,
            title = $.trim($('#blog_title').val()), content = tinyMCE.get('blog_content').getContent({format: 'raw'});

        if (title === '' || content === '') {
            window.alert('Empty is not allowed!');
            return;
        }

        if (blogId === '') {
            //New blog
            url = SOLEIL.Global.hostName + "/blog/save_blog";
            data = {
                title: title,
                content: content,
                type: type//publish or draft
            };
            redirect = SOLEIL.Global.hostName + '/blog';
        } else {
            //Edit blog
            url = SOLEIL.Global.hostName + "/blog/edit_blog";
            data = {
                title: title,
                content: content,
                type: type,//publish or draft
                blogId: blogId
            };
            redirect = SOLEIL.Global.hostName + '/blog/index/' + blogId;
        }

        //Request
        $.ajax({
            url: url,
            type: 'POST',
            dataType: "JSON",
            data: data,
            success: function (success) {
                if (success) {
                    if (type === 'publish') {
                        location.replace(redirect);
                    } else {
                        location.replace(SOLEIL.Global.hostName + '/blog/list_blog');
                    }
                } else {
                    window.alert('Failed! Please debug.');
                }
            }
        });
    });

});
