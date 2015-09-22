<?php 

/* Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
class BlogsController extends AppController {
/*
	This controller class was created by the Blog team 
*/

	public $helpers = array('Html', 'Form', 'Session', 'GoogleMapV3', 'Js');
	public $components = array('Session','RequestHandler');
/*
	This is the function that controls the index.ctp
*/

	public function index() {
	// PHPCAKE Function to List all BLog post from the DB
		$this->set('blog_info', $this->Blog->find('all'));
	}
	//view function 
	// Uses an sqll query 
	public function view($blog_id) 
	{
		$blog_sql = 'SELECT id, title, body FROM "newsoap"."blogs" WHERE "newsoap"."blogs".id = \'' . $blog_id . '\';';
		$blog_info = $this->Blog->query($blog_sql);
		$this->set('blog_info', $blog_info);
	}

   
// Do not delete add function
// The add function is need for the add.ctp
// sumbit function is called throught the add.ctp and does not have its own view file 
	public function add() {

			}
	public function submit() 
	{
		// Data being pulled in from the text boxes from the add.ctp
		// CAKEPHP only uses arrays 
		$data =	array( 
			"Blog"	=> array 
			(

				"id" => null,  
				"title" => $this->request->data['Blog']['title'],
				"body" =>  $this->request->data['Blog']['body']
			)
		);


			$this->Blog->create();
			$this->Blog->save($data);
			$this->redirect(array("action" => "index"));
						

	}
// this function removes a blog post, the delete link is located in its view page
	public function remove($blog_id)
	{		
	$this->Blog->delete($blog_id);
	$this->redirect(array("action" => "index"));
	}




}

?>
