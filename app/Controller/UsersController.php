<?php
/* This file was the controller for the prior user auth system, we modified it based on a CakePHP bakery post to try to work with Hybridauth. The comment block at the bottom is the prior implimentation. If you wish to work on this and have questions contact Kevin Bohinski or Derek D. - Kevin Bohinski 12/1/14*/

// app/Controller/UsersController.php

//For HybridAuth
session_start();

class UsersController extends AppController {
	
    public function beforeFilter() {
        //parent::beforeFilter();	Allows anyone to call index, view, and display.
        //$this->Auth->allow('add', 'logout');	Allows anyone to call add and logout.
        //$this->Auth->autoRedirect = false;	//Manual redirect set.
		//$this->Auth->flashElement = "invalidCredentials";	//Choose element to call for flash
    }

	public function login2($provider) {
//http://bakery.cakephp.org/articles/thehanx/2012/07/27/social_login_with_hybridauth
		 require_once( WWW_ROOT . 'hybridauth/Hybrid/Auth.php' );

        $hybridauth_config = array(
            "base_url" => 'http://' . $_SERVER['HTTP_HOST'] . $this->base . "/hybridauth/", // set hybridauth path

            "providers" => array(
                "Facebook" => array(
                    "enabled" => true,
                    "keys" => array("id" => "718903374814138", "secret" => "2da259d93197b6113615717853b5b20d"),
                    "scope" => 'email',
                ),
                "Twitter" => array(
                    "enabled" => true,
                    "keys" => array("key" => "twitter_api_key", "secret" => "twitter_api_secret")
                )
// for another provider refer to hybridauth documentation
            )
        );
	echo "IM OUT OF THE TRY";
        try {
            // create an instance for Hybridauth with the configuration file path as parameter
            $hybridauth = new Hybrid_Auth($hybridauth_config);

            // try to authenticate the selected $provider
            $adapter = $hybridauth->authenticate($provider);

            // grab the user profile
            $user_profile = $adapter->getUserProfile();

//debug($user_profile); //uncomment this to print the object
//exit();
            //$this->set( 'user_profile',  $user_profile );
           
            //login user using auth component
            if (!empty($user_profile)) {
                $user = $this->_findOrCreateUser($user_profile, $provider); // optional function if you combine with Auth component
                unset($user['password']);
                $this->request->data['User'] = $user;
                if ($this->Auth->login($this->request->data['User'])) {
                    $this->redirect($this->Auth->redirect());
                    $this->Session->setFlash('You are successfully logged in');
                } else {
                    $this->Session->setFlash('Failed to login');
                }
            }
        } catch (Exception $e) {
            // Display the recived error
		echo "IM IN THE CATCH";
            switch ($e->getCode()) {
                case 0 : $error = "Unspecified error.";
                    break;
                case 1 : $error = "Hybriauth configuration error.";
                    break;
                case 2 : $error = "Provider not properly configured.";
                    break;
                case 3 : $error = "Unknown or disabled provider.";
                    break;
                case 4 : $error = "Missing provider application credentials.";
                    break;
                case 5 : $error = "Authentification failed. The user has canceled the authentication or the provider refused the connection.";
                    break;
                case 6 : $error = "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
                    $adapter->logout();
                    break;
                case 7 : $error = "User not connected to the provider.";
                    $adapter->logout();
                    break;
            }

            // well, basically you should not display this to the end user, just give him a hint and move on..
            $error .= "Original error message: " . $e->getMessage();
            $error .= "Trace: " . $e->getTraceAsString();
            $this->set('error', $error);
        }
    }


// this is optional function to create user if not already in database. you can do anything with your hybridauth object
private function _findOrCreateUser($user_profile = array(), $provider=null) {
        if (!empty($user_profile)) {
            $user = $this->User->find('first', array('conditions' => array(
                'OR'=>array('User.username' => $user_profile->identifier, 'User.email'=>$user_profile->email))));
            if (!$user) {
                $this->User->create();
                $this->User->set(array(
                    'group_id' => 2,
                    'first_name' => $user_profile->firstName,
                    'last_name' => $user_profile->lastName,
                    'email' => $user_profile->email,
                    'username' => $user_profile->identifier,
                    'password' => AuthComponent::password($user_profile->identifier), //in case you need to save password to database
                    'country' => $user_profile->country,
                    'city' => $user_profile->city,
                    'address' => $user_profile->address,
                    //add another fields you want
                ));
                if ($this->User->save()) {
                    $this->User->recursive = -1;
                    $user = $this->User->read(null, $this->User->getLastInsertId());
                    return $user['User'];
                }
            } else {
                return $user['User'];
            }
        }
	}

	public function login() {
		if ($this->request->is('post')) {
        		if ($this->Auth->login()) {
            			return $this->redirect($this->Auth->redirect());
        		} else {
            			$this->Session->setFlash('Username or password is incorrect');
        		}
    		}	
	}
	
    public function logout() {
        $this->Connect->FB->destroysession();
        $this->Session->destroy();
        $this->Auth->logout();
        $this->redirect('/');
    }
	
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function dashboard() {
        $userId = $this->Session->read('Auth.User.username');
        if ($userId !== null)
        {
        	$this->set('username', $userId);
        }

    }
   /* 
    public function isAuthorized($user) {	//Checks to see if a user is logged in. If not, access is denied.
    
	    if ($this->action === 'dashboard' && $this->Auth->user('id') !== null) {
	       // Registered users can view the dashboard
	        return true;
	    }
	    else if ($this->action === 'delete' && $user['role'] === 'admin')
	    	return true;
	    	
	    else
	    	return false;
	}

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
	$this->layout = 'login';
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Account has been created. Welcome to SOAP!', 'uploadSuccess');
                $this->redirect(array('controller' => 'pages', 'action' => 'main'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
*/
}
?>
