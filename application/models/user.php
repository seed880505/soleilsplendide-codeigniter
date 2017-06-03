<?php

class User extends DataMapper
{

  var $table = 'users';
  var $has_many = array('article');

  var $validation = array(
    'name' => array(
      'label' => 'Username',
      'rules' => array('required', 'trim', 'max_length' => 128),
    ),
    'email' => array(
      'label' => 'Email Address',
      'rules' => array('required', 'trim', 'valid_email', 'max_length' => 128)
    ),
    'password' => array(
      'label' => 'Password',
      'rules' => array('required', 'trim', 'min_length' => 6, 'max_length' => 128, 'encrypt'),
    ),
    'record' => array(
      'label' => 'Record',
      'rules' => array('required', 'trim', 'min_length' => 6, 'max_length' => 128),
    ),
    'from' => array(
      'label' => 'From',
      'rules' => array('required', 'trim'),
    ),
    'salt' => array(
      'label' => 'Salt words',
      'rules' => array('max_length' => 128),
    ),
  );


  function login()
  {
    // Create a temporary user object
    $u = new User();

    // Get this users stored record via their username
    $u->where('email', $this->email)->get();

    // Give this user their stored salt
    $this->salt = $u->salt;

    // this will see the 'encrypt' validation run, encrypting the password with the salt
    $this->validate()->get();

    // If the username and encrypted password matched a record in the database,
    // this user object would be fully populated, complete with their ID.

    // If there was no matching record, this user would be completely cleared so their id would be empty.
    if (empty($this->id)) {
      // Login failed, so set a custom error message
      //$this->error_message('login', 'Username or password invalid');
      return FALSE;
    } else {
      // Login succeeded
      return TRUE;
    }
  }


  // Validation prepping function to encrypt passwords
  // If you look at the $validation array, you will see the password field will use this function
  function _encrypt($field)
  {
    // Don't encrypt an empty string
    if (!empty($this->{$field})) {
      // Generate a random salt if empty
      if (empty($this->salt)) {
        $this->salt = md5(uniqid(rand(), true));
      }

      $this->{$field} = sha1($this->salt . $this->{$field});
    }
  }
}

/* End of file user.php */
/* Location: ./application/models/user.php */