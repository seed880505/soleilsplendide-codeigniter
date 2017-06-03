<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/Home
     *    - or -
     *        http://example.com/index.php/Home/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/Home/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function index()
    {
        //SLASH
        /*if (preg_match("@/www/soleilsplendide.com@", BASEPATH) AND $this->session->userdata('logged_in')==false)
        {
            $this->load->view('tpl_slash');
        }*/

        $list_articles = array();

        $article = new Article();
        $article->where("status", "publish");
        $article->order_by("createtime", "desc");
        $article->limit(10);
        $article->get_iterated();

        if (!$article->exists()) {

            $list_articles = null;
        } else {

            foreach ($article as $value) {

                $list_articles[$value->id]['id'] = $value->id;
                $list_articles[$value->id]['title'] = $value->title;

                //Limit the number of words in post
                $content = strip_tags(base64_decode($value->content));
                $content = preg_replace('/\s+?(\S+)?$/', '', substr($content, 0, 340));
                $list_articles[$value->id]['content'] = $content."...";

                $list_articles[$value->id]['status'] = $value->status;
                $list_articles[$value->id]['createtime'] = $value->createtime;
                $list_articles[$value->id]['lastmodifiedtime'] = $value->lastmodifiedtime;
            }
        }
        unset($article);

        //GET THE MOST POPULAR ARTICLE
        $this->load->helper('general_helper');
        $most_popular_articles = get_most_popular_blogs();

        //GET THE LATEST ARTICLE
        $this->load->helper('general_helper');
        $latest_articles = get_latest_blogs();

        $data = array(
            'list_articles' => $list_articles,
            'most_popular_articles' => $most_popular_articles,
            'latest_articles' => $latest_articles
        );

        $this->load->vars($data);
        $this->load->view('tpl_public_header');
        $this->load->view('tpl_index');
        $this->load->view('tpl_public_footer');
    }

    function maps_mode()
    {
        //$this->load->get_var("login_url");
        // echo "this<pre>"; print_r($oo); echo "</pre>"; exit;

        $this->load->view('tpl_public_header');
        $this->load->view('tpl_maps_mode');
        $this->load->view('tpl_public_footer');
    }

    //SIGN UP FOR FACEBOOK USERS
    function register_facebook($userdata)
    {
        $this->load->helper('string');

        $temp = random_string('alnum', 12);

        $u = new User();
        $u->name = $userdata['name'];
        $u->password = $temp;
        $u->record = $temp;
        $u->email = $userdata['email'];
        $u->from = "facebook";
        $u->salt = md5(uniqid(rand(), true));

        if ($u->save()) {
            $data = array(
                'userid' => $u->id,
                'username' => $u->name,
                'email' => $u->email,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($data);
            session_destroy();
            unset($u);
        } else {
            foreach ($u->error->all as $e) {
                echo $e . "<br />";
            }
            unset($u);
        }

    }


    function check_facebookuser($email)
    {
        $user = new User();
        $user->where('email', $email);
        $user->where('from', 'facebook');
        $user->get();

        if ($user->id != '') {
            $data = array(
                'userid' => $user->id,
                'username' => $user->name,
                'email' => $user->email,
                'logged_in' => TRUE
            );
            unset($user);
            return $data;
        } else {
            unset($user);
            return "not_exist";
        }
    }


    function googleMaps($place_id = null)
    {
        $place = new Place;
        $place->get_by_id($place_id);

        $data["place_location"] = $place->to_array();
        $this->load->vars($data);
        $this->load->view('tpl_google_maps_single');
        // echo "POINT HERE<pre>"; print_r($data); echo "</pre>"; exit;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */