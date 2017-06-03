/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/05/13
 * Time: 21:48
 * To change this template use File | Settings | File Templates.
 */



/*jslint browser: true */
/*global document, $, confirm, alert */

$(function () {
    'use strict';

    var file_table, image_table, profile_table;
    //DATATABLES
    file_table = $('#list_files').dataTable({
        // "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
    // Sort immediately with columns 0 and 1
    file_table.fnSort([
        [7, 'desc']
    ]);

    image_table = $('#list_images').dataTable({
        // "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
    // Sort immediately with columns 0 and 1
    image_table.fnSort([
        [7, 'desc']
    ]);

    profile_table = $('#list_profile_photos').dataTable({
        // "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
    // Sort immediately with columns 0 and 1
    profile_table.fnSort([
        [7, 'desc']
    ]);


    //SUBMIT DELETING FORM
    $("input#delete_item").click(function () {

        var result = confirm("Do you confirm to delete this file ?"), filename, filetype;

        if (result) {
            filename = $(this).attr("filename");
            filetype = $(this).attr("filetype");

            $.get("<?php echo site_url('file/delete_file'); ?>", {filename: filename, filetype: filetype},
                function (data) {
                    if (data === true) {

                        alert('Successful!');
                        setTimeout(function () {
                            //noinspection JSCheckFunctionSignatures
                            window.location.reload();
                        }, 1000);
                    }
                    else {

                        alert('Failed, please try again later!');
                    }
                });
        }
    });

    //SUBMIT RENAME FORM
    $("input#rename_image").click(function () {
        var count = $(this).attr("clickcount");
        $("input[clickcount='" + count + "']").hide();
        $("input[count='" + count + "'], input[namecount='" + count + "']").fadeIn();
    });

    $("input#rename_profile").click(function () {
        var count = $(this).attr("profileclickcount");
        $("input[profileclickcount='" + count + "']").hide();
        $("input[profilecount='" + count + "'], input[profilenamecount='" + count + "']").fadeIn();
    });

    $("input#rename_file").click(function () {
        var count = $(this).attr("fileclickcount");
        $("input[fileclickcount='" + count + "']").hide();
        $("input[filecount='" + count + "'], input[filenamecount='" + count + "']").fadeIn();
    });

    $("input#confirm_rename_item").click(function () {

        var filename, filetype, count, new_filename;
        filename = $(this).attr("filename");
        filetype = $(this).attr("filetype");

        if (filetype === 'image') {
            count = $(this).attr("count");
            new_filename = $("input[namecount='" + count + "']").val();
        }
        else if (filetype === 'file') {
            count = $(this).attr("filecount");
            new_filename = $("input[filenamecount='" + count + "']").val();
        }
        else if (filetype === 'profile') {
            count = $(this).attr("profilecount");
            new_filename = $("input[profilenamecount='" + count + "']").val();
        }

        if (new_filename === '') {
            alert("File's name can not be null!");
        }
        else {
            $.get("<?php echo site_url('file/rename_file'); ?>", {filename: filename, filetype: filetype, new_filename: new_filename},
                function (data) {
                    if (data === true) {

                        alert('Successful!');
                        setTimeout(function () {
                            //noinspection JSCheckFunctionSignatures
                            window.location.reload();
                        }, 1000);
                    }
                    else {

                        alert('Failed, please try again later!');
                    }
                });
        }
    });


    $("input#download_item").click(function () {
        var result = confirm("Download this file ?"), count;

        if (result) {
            count = $(this).attr("downloadcount");

            $("form#" + count).submit();
        }

    });

    //SELECT ALL EFFECT
    $("input#item_link").bind("click", function () {
        $(this).select();
    });


});

