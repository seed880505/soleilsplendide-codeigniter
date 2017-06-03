<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class file extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file', 'download'));
    }

    function index()
    {
        $this->load->helper('file');
        $files = get_dir_file_info('./uploads/files/', $top_level_only = TRUE);
        $images = get_dir_file_info('./uploads/images/', $top_level_only = TRUE);
        $profile_photos = get_dir_file_info('./uploads/profile/', $top_level_only = TRUE);
        // echo "POINT HERE<pre>"; print_r($files); echo "</pre>"; exit;

        $data = array("files" => $files, "images" => $images, "profile_photos" => $profile_photos);

        $this->load->vars($data);
        $this->load->view('tpl_public_header');
        $this->load->view('tpl_file_list');
        $this->load->view('tpl_public_footer');
    }

    function new_document()
    {
        $this->load->view('tpl_public_header');
        $this->load->view('tpl_new_document');
        $this->load->view('tpl_public_footer');
    }

    function new_image()
    {
        $this->load->view('tpl_public_header');
        $this->load->view('tpl_new_image', array('error' => ' '));
        $this->load->view('tpl_public_footer');
    }

    function do_upload_image($image_name = null)
    {
        $config['upload_path'] = './uploads/images/';
        $config['allowed_types'] = '*';
        // $config['file_name'] = '';
        //test
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors(),
                'result_image' => false,
            );
            $this->load->view('tpl_public_header');
            $this->load->view('tpl_new_image', $error);
            $this->load->view('tpl_public_footer');
        } else {
            $data = array('upload_data' => $this->upload->data(),
                'result_image' => true,
            );

            $this->load->view('tpl_public_header');
            $this->load->view('tpl_new_image', $data);
            $this->load->view('tpl_public_footer');
        }
    }

    function do_upload_profile_image($image_name = null)
    {
        $config['upload_path'] = './uploads/profile/';
        $config['allowed_types'] = '*';
        // $config['file_name'] = '';
        //test
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors(),
                'result_profile_image' => false,
            );
            $this->load->view('tpl_public_header');
            $this->load->view('tpl_new_image', $error);
            $this->load->view('tpl_public_footer');
        } else {
            $data = array('upload_data' => $this->upload->data(),
                'result_profile_image' => true,
            );

            $this->load->view('tpl_public_header');
            $this->load->view('tpl_new_image', $data);
            $this->load->view('tpl_public_footer');
        }
    }

    function do_upload_file($file_name = null)
    {
        $config['upload_path'] = './uploads/files/';
        $config['allowed_types'] = '*';
        // $config['file_name'] = '';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors(),
                'result_file' => false,
            );
            $this->load->view('tpl_public_header');
            $this->load->view('tpl_new_image', $error);
            $this->load->view('tpl_public_footer');
        } else {
            $data = array('upload_data' => $this->upload->data(),
                'result_file' => true,
            );

            $this->load->view('tpl_public_header');
            $this->load->view('tpl_new_image', $data);
            $this->load->view('tpl_public_footer');
        }
    }

    function delete_file()
    {
        $file_name = $this->input->get("filename");
        $filetype = $this->input->get("filetype");

        if ($filetype == "image") {
            $result = unlink("./uploads/images/" . $file_name . "");
        } else if ($filetype == "file") {
            $result = unlink("./uploads/files/" . $file_name . "");
        } else if ($filetype == "profile") {
            $result = unlink("./uploads/profile/" . $file_name . "");
        }

        if ($result) {
            echo true;
        } else {
            echo false;
        }

    }

    function rename_file()
    {
        $file_name = $this->input->get("filename");
        $filetype = $this->input->get("filetype");
        $new_filename = $this->input->get("new_filename");

        $info = pathinfo($file_name);
        if ($filetype == "image") {
            $result = rename("./uploads/images/" . $info['filename'] . "." . $info['extension'] . "", "./uploads/images/" . $new_filename . "." . $info['extension'] . "");
        } else if ($filetype == "file") {
            $result = rename("./uploads/files/" . $info['filename'] . "." . $info['extension'] . "", "./uploads/files/" . $new_filename . "." . $info['extension'] . "");
        } else if ($filetype == "profile") {
            $result = rename("./uploads/profile/" . $info['filename'] . "." . $info['extension'] . "", "./uploads/profile/" . $new_filename . "." . $info['extension'] . "");
        }

        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }

    function download_file()
    {
        $file_name = $this->input->post("filename");
        $filetype = $this->input->post("filetype");

        if ($filetype == "image") {
            $data = file_get_contents("./uploads/images/" . $file_name . ""); // Read the file's contents
            force_download($file_name, $data);
        } else if ($filetype == "file") {
            $data = file_get_contents("./uploads/files/" . $file_name . ""); // Read the file's contents
            force_download($file_name, $data);
        } else if ($filetype == "profile") {
            $data = file_get_contents("./uploads/profile/" . $file_name . ""); // Read the file's contents
            force_download($file_name, $data);
        }
    }

    function save_file()
    {
        $content = stripslashes($this->input->post('content'));
        $title = stripslashes($this->input->post('title'));
        $direction = stripslashes($this->input->post('direction'));

        $user_data = $this->session->userdata('user_data');

        $article = new Article();
        $article->user_id = $user_data['userid'];
        $article->title = $title;
        $article->content = $content;
        $article->status = $direction;

        if ($article->save()) {
            unset($article);
            redirect('/home/index/', 'refresh');
        } else {
            foreach ($article->error->all as $e) {
                echo $e . "<br />";
            }
            unset($article);
        }

        //echo "content<pre>"; print_r($content); echo "</pre>"; exit;
    }


}

/* End of file file.php */
/* Location: ./application/controllers/file.php */