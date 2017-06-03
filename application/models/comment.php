<?php

class Comment extends DataMapper
{

  var $table = 'comments';
  var $has_one = array('article');

  var $validation = array(
    'comment_mail' => array(
      'label' => 'comment_mail',
      'rules' => array('trim'),
    ),
  );


}

/* End of file user.php */
/* Location: ./application/models/user.php */