<?php

class Blog extends AppModel {
 
// Name of the Blog model
 public $name = 'Blog';

// Ensures that no null blog entries are added to the database
 public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
// THis is not used 

 public function isOwnedBy($blog_info) { //$user
     return $this->field('id', array('id' => $blog_info)) === $blog_info;
//'user_id' => $user
	}


}
?>


