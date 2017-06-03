/*jslint browser: true */
/*global document, $, SOLEIL */


$(function () {
    'use strict';

    var $headerSubMenu = $('#header_sub_menu'), subMenuDom, $scrollTop = $('#toTop'), $menuArea = $('#menu_area'),
        menuOffset = $menuArea.offset(), menuHeight, $logoArea = $('#logo_area'),
        $searchSubmit = $('#search-submit');

    //Active color for logo and menu
    $('a.active_section').css('color', SOLEIL.Global.activeColor);

    //Active color for search bar
    $searchSubmit.css('background-color', SOLEIL.Global.activeColor);

    //Active color for footer
    $('footer').css('border-top-color', SOLEIL.Global.activeColor);


    //Search bar focus/click listener
    $('#search_blog').focus(function () {
        $('#search-submit').addClass('searchFocus');
    }).blur(function () {
        $('#search-submit').removeClass('searchFocus');
    });

    //Search bar click listener
    $searchSubmit.click(function () {
        $('#searchBarForm').submit();
    });

    //ColorBox plugin
    $("#userLogin").colorbox({width: 550});

    //Header sub menu items
    switch (SOLEIL.Global.currentPage) {
        case 'home':
            break;
        case 'blog':
            if (SOLEIL.Global.userLogin) {
                subMenuDom = '<ul>' +
                    '<li><a href="' + SOLEIL.Global.hostName + '/blog/new_blog">New Article</a></li>' +
                    '<li><a href="' + SOLEIL.Global.hostName + '/blog/list_blog">All Articles</a></li>' +
                    '</ul>';
                $headerSubMenu.html(subMenuDom);
            }
            break;
        case 'file':
            if (SOLEIL.Global.userLogin) {
                subMenuDom = '<ul>' +
                    '<li><a href="' + SOLEIL.Global.hostName + '/file/new_image">Upload file</a></li>' +
                    '<li><a href="' + SOLEIL.Global.hostName + '/file/new_document">Write new file</a></li>' +
                    '</ul>';
                $headerSubMenu.html(subMenuDom);
            }
            break;
        case 'contact':
            break;
        default:
    }

    //Hover color for sub menu
    $('.divider').find('a').hover(function () {
        $(this).css('color', SOLEIL.Global.activeColor);
    }, function () {
        $(this).css('color', 'inherit');
    });

    //Searching blog
    $("#search_blog").autocomplete({
        delay: 200,
        minLength: 2,
        appendTo: "header",//Fixed to header.
        source: function (request, response) {
            $.ajax({
                url: SOLEIL.Global.hostName + "/blog/searchblog",
                type: 'POST',
                dataType: "JSON",
                data: {
                    search_text: $.trim(request.term),
                    search_type: 'ajax'
                },
                success: function (data) {
                    var titles = [], key;
                    /** @namespace data.articles */
                    if (data !== null) {
                        for (key in data.articles) {
                            if (data.articles.hasOwnProperty(key)) {
                                titles.push({
                                    label: data.articles[key].title,
                                    value: data.articles[key].title,
                                    blogId: data.articles[key].id//custom property
                                });
                            }
                        }
                    }
                    //window.console.log(data);
                    response(titles);
                }
            });
        },
        select: function (event, ui) {
            var blog_id = ui.item.blogId, site_url;
            site_url = SOLEIL.Global.hostName + "/blog/index/" + blog_id;
            window.location = site_url;
            return false;
        }
    });

    //Window scrolling
    $(window).scroll(function () {

        var windowScrollTop = $(this).scrollTop();

        //Back to top
        if (windowScrollTop === 0) {
            $scrollTop.fadeOut('fast');
        } else {
            $scrollTop.filter(':hidden').fadeIn('fast');
        }

        //Fixed menu bar
        if (windowScrollTop > menuOffset.top) {
            if (!$menuArea.hasClass('fixedTrue')) {
                $menuArea.addClass('fixedTrue').removeClass('fixedFalse').css({position: 'fixed', top: 0});
                menuHeight = $menuArea.height();
                $logoArea.after('<div style="height: ' + menuHeight + 'px" id="tempDiv"></div>');
            }
        } else {
            if (!$menuArea.hasClass('fixedFalse')) {
                $menuArea.addClass('fixedFalse').removeClass('fixedTrue').css({position: '', top: ''});
                $('#tempDiv').remove();
            }
        }
    });

    //Back to top click event
    $scrollTop.click(function () {
        $('html, body').animate({scrollTop: 0}, 'fast');
    });


    //Google analytics
    (function (i, s, o, g, r, a, m) {
        //noinspection JSLint
        i['GoogleAnalyticsObject'] = r;
        //noinspection JSLint
        i[r] = i[r] || function () {
            //noinspection JSLint
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-43450979-1', 'soleilsplendide.com');
    ga('send', 'pageview');

});