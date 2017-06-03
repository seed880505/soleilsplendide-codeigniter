/**
 * Created with JetBrains PhpStorm.
 * User: ppmm
 * Date: 04/08/13
 * Time: 12:51
 * To change this template use File | Settings | File Templates.
 */

var SOLEIL = SOLEIL || {};


SOLEIL.Global = {

    userLogin: false,
    activeColor: '',
    currentPage: '',
    hostName: '',
    baseUrl: '',
    emailReg: /^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z\s]{2,4}$/,
    blogContent: ''
};


SOLEIL.Util = (function () {
    "use strict";

    //"private" variables:
    var myPrivateVar = "I can be accessed only from within YAHOO.myProject.myModule.";

    return {
        myPrivateVar: myPrivateVar
    };

}());


/**
 * Less configuration
 * @type {{env: string, async: boolean, fileAsync: boolean, poll: number, functions: {}, dumpLineNumbers: string, relativeUrls: boolean}}
 */
var less = {
    env: "development", // or "production"
    async: false,       // load imports async
    fileAsync: false,   // load imports async when in a page under a file protocol
    poll: 1000,         // when in watch mode, time in ms between polls
    functions: {},      // user functions, keyed by name
    dumpLineNumbers: "mediaQuery", // "comments" or "mediaQuery" or "all"
    relativeUrls: false // whether to adjust url's to be relative if false, url's are already relative to the entry less file
    /*rootpath: ":/a.com/"*/// a path to add on to the start of every url resource
};