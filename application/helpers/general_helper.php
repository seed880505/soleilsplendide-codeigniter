<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Return the most visited articles
 * @return array
 */
function get_most_popular_blogs(){
    //GET THE NEWEST ARTICLE FOR BLOG PAGE
    $data = array();
    $article = new Article();
    $article->where("status", "publish");
    $article->order_by("visit", "desc");
    $article->limit(5);
    $article->get_iterated();

    foreach ($article as $key => $value) {
        $data[$key]["id"] = $value->id;
        $data[$key]["title"] = $value->title;
    }
    unset($article);

    return $data;
}

/**
 * Return the latest articles
 * @return array
 */
function get_latest_blogs(){
    //GET THE NEWEST ARTICLE FOR BLOG PAGE
    $data = array();
    $article = new Article();
    $article->where("status", "publish");
    $article->order_by("createtime", "desc");
    $article->limit(5);
    $article->get_iterated();

    foreach ($article as $key => $value) {
        $data[$key]["id"] = $value->id;
        $data[$key]["title"] = $value->title;
    }
    unset($article);

    return $data;
}



