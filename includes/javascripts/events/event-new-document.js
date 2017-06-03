/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/05/13
 * Time: 21:54
 * To change this template use File | Settings | File Templates.
 */
/*jslint browser: true */
/*global document, $, tinyMCE */


$(function () {
    'use strict';

    // user-defined plugins and themes should be identical to those in "tinyMCE.init" below.
    /*tinyMCE_GZ.init({
     plugins : "fullpage",
     themes : 'simple,advanced',
     languages : 'en',
     disk_cache : true,
     debug : false
     });*/

    //user-defined plugins and themes should be identical to those in "tinyMCE_GZ.init" above i.e.
    tinyMCE.init({
        // General options
        mode: "textareas",
        theme: "advanced",
        plugins: "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1: "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,

        // Skin options
        skin: "o2k7",
        skin_variant: "silver"
    });
    //now add your normal init, which will not be added to the tinyMCE_GZ.init above

//JQUERY UI TABS
    $(function () {
        $("#tabs").tabs();
    });


//JQUERY BUTTON
    $("input:button").button();

    $("input#publish").click(function () {
        $("input:hidden").val("publish");
        $("form").submit();
    });

    $("input#draft").click(function () {
        $("input:hidden").val("draft");
        $("form").submit();
    });


});
