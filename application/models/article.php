<?php

class Article extends DataMapper {

	var $table = 'articles';
    var $has_many = array('comment');
    var $has_one = array('user');

    var $validation = array(
        'user_id' => array(
            'label' => 'User id',
            'rules' => array('required'),
        ),
        'title' => array(
            'label' => 'Title',
            'rules' => array('required', 'trim', 'max_length' => 255)
        ),
		'content' => array(
            'label' => 'Content',
            'rules' => array('required'),
        ),
        'createtime' => array(
            'label' => 'Createtime',
        ),
    );

	

}

/* End of file user.php */
/* Location: ./application/models/user.php */