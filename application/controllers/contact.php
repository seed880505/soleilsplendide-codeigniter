<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller
{

    function index()
    {
        if ($_POST) {

            $comment_name = $this->input->post('comment_name');
            $comment_mail = $this->input->post('comment_mail');
            $comment_website = $this->input->post('comment_website');
            $comment_textarea = $this->input->post('comment_textarea');

            $this->load->library('email');

            $this->email->from($comment_mail, $comment_name);
            $this->email->to('contact@soleilsplendide.com');
            $this->email->subject('Your blog website message - soleilsplendide.com');
            $this->email->message($comment_textarea . "\r\n" . $comment_website . "\r\n");
            $result = $this->email->send();

            if ($result) {

                echo json_encode(true);
            } else {

                echo json_encode(false);
            }

        } else {

            $this->load->helper('file');
            $images = get_dir_file_info('./uploads/profile/', $top_level_only = TRUE);

            /*
            $this->load->library('image_lib');

            foreach ($images as $value) {
                $image_path = "./uploads/profile_thumb/" . $value['name'];

                if (!file_exists($image_path)) {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $value['relative_path'] . $value['name'];
                    $config['create_thumb'] = TRUE;
                    $config['new_image'] = $image_path;
                    $config['maintain_ratio'] = false;
                    $config['thumb_marker'] = "";
                    $config['width'] = 250;
                    $config['height'] = 250;

                    $this->image_lib->initialize($config);

                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors('<p>', '</p>');
                    }
                    $this->image_lib->clear();
                }
            }*/

            $data = array("images" => $images);

            $this->load->vars($data);
            $this->load->view('tpl_public_header');
            $this->load->view('tpl_contact_me');
            $this->load->view('tpl_public_footer');
        }

    }

}