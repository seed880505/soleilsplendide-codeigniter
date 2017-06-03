<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller
{

    //DEFAULT FUNCTION
    function index($id = null, $urlSuffix = null)
    {
        $data = array();
        $article = new Article();

        if (isset($id)) {

            //GET THE SPECIFIC ARTICLE
            $article->get_by_id($id);
            $str_suffix = url_title($article->title, 'dash', TRUE);

            if (!isset($urlSuffix) OR $urlSuffix !== $str_suffix) {

                redirect("blog/index/" . $article->id . "/" . $str_suffix);
            }

        } else {

            //GET THE MAIN ARTICLE FOR HOMEPAGE
            $article->where("status", "publish");
            $article->order_by("createtime", "desc");
            $article->limit(1);
            $article->get();
            if ($article->exists()) {

                $article_id = $article->id;
                $str_suffix = url_title($article->title, 'dash', TRUE);
                redirect("blog/index/" . $article_id . "/" . $str_suffix);
            } else {
                redirect("home");
            }
        }

        //GET THE MAIN ARTICLE FOR BLOG PAGE
        $article->user->get();
        $data["main"]["id"] = $article->id;
        $data["main"]["title"] = $article->title;
        $data["main"]["content"] = base64_decode($article->content);
        $data["main"]["username"] = $article->user->name;
        $data["main"]["createtime"] = $article->createtime;
        $data["main"]["comments"] = $this->get_comments($id);

        //Analytics: save the visit of this post in DB
        $article->visit = ($article->visit + 1);
        $article->save();

        unset($article);

        //GET THE NEWEST ARTICLE FOR BLOG PAGE
        $this->load->helper('general_helper');
        $data["list_5"] = get_latest_blogs();

        $this->load->helper('text');
        $data["main"]["striped_title"] = $data["main"]["title"];
        $data["current_url"] = site_url() . '/' . $this->uri->uri_string();
        $data["main"]["striped_content"] = word_limiter(strip_tags($data["main"]["content"]), 30);

        $this->load->vars($data);
        $this->load->view('tpl_public_header');
        $this->load->view('tpl_public_blog');
        $this->load->view('tpl_public_footer');
    }


    //GET THE COMMENTS OF PASSAGE
    function get_comments($passage_id = null)
    {
        if ($passage_id == null) {
            return null;
        }

        $comments_array = array();

        $comment = new Comment();
        $comment->where("article_id", $passage_id);
        $comment->get_iterated();

        if ($comment->exists()) {
            foreach ($comment as $key => $value) {

                $comments_array[$key] = $value->to_array();

                //Overwrite: transform \n\t to <br>
                $comments_array[$key]["comment_content"] = nl2br($value->comment_content, false);

                //Gravatar requires for avatar
                $comments_array[$key]["mail_hash"] = md5(strtolower(trim($value->comment_mail)));
            }
            unset($comment);

            return $comments_array;
        }

        return null;
    }


    /**
     * Create new blog in template
     */
    function new_blog($id = null)
    {
        //Save the new blog
        if ($id == null) {

            $this->load->view('tpl_public_header');
            $this->load->view('tpl_new_blog');
            $this->load->view('tpl_public_footer');

            //Edit the previous blog
        } else {

            $article = new Article();
            $article->where("id", $id);
            $article->get();

            if ($article->exists()) {

                $blogData = array();
                $blogData['id'] = $article->id;
                $blogData['title'] = $article->title;

                /*Normally, i don't need this replace. But if i enter the 'break line' in code mode
                  in tinyMice, it will cause the error. So i replace the break line to <br>,
                  just in case of happening*/
                $blogData['content'] = str_replace("\n", "<br>", base64_decode($article->content));

                $this->load->vars(array(
                    'blog_data' => $blogData
                ));
                $this->load->view('tpl_public_header');
                $this->load->view('tpl_new_blog');
                $this->load->view('tpl_public_footer');
            }
        }
    }


    /**
     * List all blog for operating.
     */
    function list_blog()
    {
        $list_articles = array(); //article data
        $article = new Article();
        $article->get_iterated();

        if (!$article->exists()) {

            $all_count = 0;
            $list_articles = null;
        } else {

            $all_count = $article->result_count();

            foreach ($article as $value) {

                $list_articles['user'] = $value->user_id;
                $tmp_title = $value->title;
                $tmp_content = substr(strip_tags(base64_decode($value->content)), 0, 150);

                $list_articles['articles'][$value->id]['id'] = $value->id;
                $list_articles['articles'][$value->id]['title'] = $tmp_title;
                $list_articles['articles'][$value->id]['content'] = $tmp_content;
                $list_articles['articles'][$value->id]['status'] = $value->status;
                $list_articles['articles'][$value->id]['createtime'] = $value->createtime;
                $list_articles['articles'][$value->id]['lastmodifiedtime'] = $value->lastmodifiedtime;
            }
        }
        unset($article);

        $data = array(
            'list_articles' => $list_articles,
            'all_count' => $all_count
        );

        //echo "list_articles<pre>"; print_r($list_articles); echo "</pre>"; exit;
        $this->load->vars($data);
        $this->load->view('tpl_public_header');
        $this->load->view('tpl_blog_list');
        $this->load->view('tpl_public_footer');
    }


    //Save blog to publish or draft
    function save_blog()
    {
        $type = $this->input->post("type");
        $title = $this->input->post("title");
        $string = str_replace('\'', '&apos;', $this->input->post("content"));
        $content = base64_encode($string);
        $user_data = $this->session->userdata("user_data");
        $article = new Article();
        $article->user_id = $user_data["userid"];
        $article->title = $title;
        $article->content = $content;
        $article->status = $type;
        $article->lastmodifiedtime = date("Y-m-d, H:i:s");

        if ($article->save()) {

            echo json_encode(true);
        } else {

            echo json_encode(false);
        }
        unset($article);
    }


    //Editing blog to publish or draft
    function edit_blog()
    {
        $title = $this->input->post("title");
        $string = str_replace('\'', '&apos;', $this->input->post("content"));
        $content = base64_encode($string);
        $blogId = $this->input->post("blogId");
        $last_modified_time = date("Y-m-d, H:i:s");

        $data = array(
            'title' => $title,
            'content' => $content,
            'lastmodifiedtime' => $last_modified_time
        );
        $article = new Article();
        $success = $article->where("id", $blogId)->update($data);
        unset($article);

        if ($success) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }


    /**
     * Operating blog
     */
    function blog_operation()
    {
        $op = $this->input->post('op');
        $id = $this->input->post('id');

        $article = new Article();
        $last_modified_time = date("Y-m-d, H:i:s");

        switch ($op) {

            case 'publish':
                $param = array(
                    'status' => 'publish',
                    'lastmodifiedtime' => $last_modified_time
                );
                $success = $article->where("id", $id)->update($param);
                if ($success) {
                    echo json_encode(true);
                } else {
                    echo json_encode(false);
                }
                break;

            case 'draft':
                $param = array(
                    'status' => 'draft',
                    'lastmodifiedtime' => $last_modified_time
                );
                $success = $article->where("id", $id)->update($param);
                if ($success) {
                    echo json_encode(true);
                } else {
                    echo json_encode(false);
                }
                break;

            case 'delete':
                $article->get_by_id($id);
                $success = $article->delete();
                if ($success) {
                    echo json_encode(true);
                } else {
                    echo json_encode(false);
                }
                break;

            default:
                echo json_encode(false);
                break;
        }

        unset($article);
    }

    //Leave a comment
    function commentBlog()
    {
        $this->load->library('email');
        $comment_name = $this->input->post('comment_name');
        $comment_mail = $this->input->post('comment_mail');
        $comment_website = $this->input->post('comment_website');
        $comment_textarea = $this->input->post('comment_textarea');
        $comment_passage_id = $this->input->post('comment_passage_id');

        if ($comment_website !== '' AND !preg_match("@http://@", $comment_website)) {
            $comment_website = "http://" . $comment_website;
        }

        $comment = new Comment();
        $comment->article_id = $comment_passage_id;
        $comment->comment_name = $comment_name;
        $comment->comment_mail = $comment_mail;
        $comment->comment_website = $comment_website;
        $comment->comment_content = $comment_textarea;
        $success = $comment->save();

        if ($success) {

            //Send an email to me
            $this->email->from($comment_mail, $comment_name);
            $this->email->to('contact@soleilsplendide.com');
            $this->email->subject('New comment for your blog - soleilsplendide');
            $this->email->message($comment_textarea . "\r\n" . $comment_website . "\r\n");
            $this->email->send();

            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }


    function searchBlog()
    {

        $list_articles = array(); //article data
        $article = new Article();
        $article->where("status", "publish");

        if ($_POST) {

            //If searching, need specific conditions
            $search_text = $this->input->post("search_text");
            $search_type = $this->input->post("search_type"); //'table' or 'ajax'
            $article->like('title', $search_text);
        }

        $article->get_iterated();
        if (!$article->exists()) {

            $all_count = 0;
            $list_articles = null;
        } else {

            $all_count = $article->result_count();

            foreach ($article as $value) {

                $list_articles['user'] = $value->user_id;
                $tmp_title = $value->title;
                $tmp_content = substr(strip_tags(base64_decode($value->content)), 0, 140);

                $tmp_last_modified_time = date("jS F Y", strtotime($value->lastmodifiedtime));
                $tmp_create_time = date("jS F Y", strtotime($value->createtime));

                $list_articles['articles'][$value->id]['id'] = $value->id;
                $list_articles['articles'][$value->id]['title'] = $tmp_title;
                $list_articles['articles'][$value->id]['content'] = $tmp_content;
                $list_articles['articles'][$value->id]['status'] = $value->status;
                $list_articles['articles'][$value->id]['createtime'] = $tmp_create_time;
                $list_articles['articles'][$value->id]['lastmodifiedtime'] = $tmp_last_modified_time;
            }
        }

        $data = array(
            'list_articles' => $list_articles,
            'all_count' => $all_count,
        );

        unset($article);

        if (isset($search_type) AND $search_type == 'ajax') {

            echo json_encode($list_articles);
        } else {

            $this->load->vars($data);
            $this->load->view('tpl_public_header');
            $this->load->view('tpl_public_blog_list');
            $this->load->view('tpl_public_footer');
        }

    }


}//END CLASS


/* End of file auth.php */
/* Location: ./application/controllers/auth.php */