/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/05/13
 * Time: 21:57
 * To change this template use File | Settings | File Templates.
 */
/*jslint browser: true */
/*global document, $ */

$(function () {
    'use strict';

    $('#table_list_blogs').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
});
