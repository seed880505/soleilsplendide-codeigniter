/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/05/13
 * Time: 21:41
 * To change this template use File | Settings | File Templates.
 */
/*jslint browser: true */
/*global document, $, SOLEIL */

$(function () {
    'use strict';

    var op_blog;

    //Data table
    $('#list_table').dataTable({
        "bJQueryUI": true,
        "aaSorting": [
            [4, 'desc']
        ],// Sort immediately with create date
        "sPaginationType": "full_numbers"
    });


    op_blog = function (op, id) {

        $.ajax({
            url: SOLEIL.Global.hostName + "/blog/blog_operation",
            type: 'POST',
            dataType: "JSON",
            data: {
                op: op,
                id: id
            },
            success: function (data) {

                if (data) {

                    location.reload();
                } else {

                    window.alert('Failed, please try again later!');
                }
            }
        });
    };

    //USER OPERATION
    $(".user_operation").change(function () {

        var op = $(this).val(), id = $(this).data('article');

        switch (op) {
            case "publish":
                op_blog("publish", id);
                break;
            case "draft":
                op_blog("draft", id);
                break;
            case "edit":
                location.replace(SOLEIL.Global.hostName + '/blog/new_blog/' + id);
                break;
            case "delete":
                if (window.confirm('Really want to delete the blog ?')) {
                    op_blog("delete", id);
                }
                break;
            default:
                window.alert("error");
        }
    });


});
