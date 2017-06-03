<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function index()
    {

        $this->load->view('tpl_login');
    }

    //LOGIN USERS
    public function login()
    {

        $user_email = $this->input->post('useremail');
        $user_pass = $this->input->post('userpass');

        $user = new User();
        $user->email = $user_email;
        $user->password = $user_pass;

        if ($user->login()) {

            $userData = array(
                'userid' => $user->id,
                'username' => $user->name,
                'email' => $user->email
            );

            $this->session->set_userdata('user_data', $userData);
            $this->session->set_userdata('logged_in', TRUE);
            unset($user);
            redirect('/home', 'location');

        } else {

            //redirect('/login/index/', 'refresh');
            unset($user);
            echo "Password failed!";
        }
    }

    //Logout
    function logout()
    {
        $this->session->sess_destroy();
        redirect('/home', 'location');
    }


    //GET PASSWORD FOR USERS
    public function resetPassword()
    {

        $user_email = $this->input->post('useremail_forget');

        $u = new User();
        $u->where('email', $user_email);
        $u->get();

        $user_email = $u->email;;
        $user_name = $u->name;
        $record = $u->record;
        $email_subject = "Recieve your password for soleilsplendide.com";
        $email_body = "Hello " . $user_name . "!  \r\n\r\n Your account information: \r\n\r\n E-mail: " . $user_email . " \r\n Password: " . $record . " ";

        $this->load->library('email');
        $this->email->from('contact@soleilsplendide.com', 'Contact soleilsplendide.com');
        $this->email->to($user_email);
        $this->email->subject($email_subject);
        $this->email->message($email_body);
        $result = $this->email->send();

        if ($result) {

            redirect("home");
        } else {

            echo "Sending email failed, please try again later.";
        }

    }

    //Check the existence of email
    public function checkEmailExist()
    {

        $email = $this->input->post('email');
        $user = new User();
        $user->get_where(array('email' => $email));

        if ($user->exists()) {

            echo json_encode(true);
        } else {

            echo json_encode(false);
        }
    }

    //Load register page
    public function registerIndex()
    {
        $this->load->helper('form');
        $this->load->view('tpl_register');
    }


    //SIGN UP FOR USERS
    public function register()
    {
        $user_name = $this->input->post('username');
        $user_email = $this->input->post('useremail');
        $user_pass = $this->input->post('userpass');

        $u = new User();
        $u->name = $user_name;
        $u->password = $user_pass;
        $u->record = $user_pass;
        $u->email = $user_email;
        $u->from = "mainsite";
        $u->salt = md5(uniqid(rand(), true));

        if ($u->save()) {
            $userData = array(
                'userid' => $u->id,
                'username' => $u->name,
                'email' => $u->email,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($userData);
            unset($u);
            redirect('/home/index/', 'refresh');
        } else {

            foreach ($u->error->all as $e) {
                echo $e . "<br />";
            }
            unset($u);
        }

    }

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */