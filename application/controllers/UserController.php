<?php

class UserController extends Zend_Controller_Action {

    private $regForm = null;
    private $userModel = null;
    private $loginForm = null;

    public function init() {
        /* Initialize action controller here */

//        $authorization = Zend_Auth::getInstance();
//        if (!$authorization->hasIdentity()) {
//           $this->redirect('user/login'); 
//        }

        $this->regForm = new Application_Form_Registration();
        $this->userModel = new Application_Model_DbTable_User();
        $this->loginForm = new Application_Form_Login();
    }

    public function indexAction() {
        // action body
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('user/login');
        } else {
            
            
            
            
        }
    }

    public function registrationAction() {
        // action body
        $user_data = $this->getRequest()->getParams();
        if ($this->getRequest()->isPost()) {
            if ($this->regForm->isValid($user_data)) {

                print_r($user_data);
                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->addValidator('Size', false, 52428800, 'image');
                $upload->setDestination(APPLICATION_PATH . '/../public/uploads');
                $user_data['user_photo'] = $upload->getFileName();

                $files = $upload->getFileInfo();
                foreach ($files as $file => $info) {
                    if ($upload->isValid($file)) {
                        $upload->receive($file);
                    }
                }

                $this->userModel->addUser($user_data);
                $this->redirect('user/login');
            } else {
                $this->view->regForm = $this->regForm;
            }
        } else {
            $this->view->regForm = $this->regForm;
        }
    }

    public function loginAction() {
        // action body
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {

            if ($this->getRequest()->isPost()) {

                $username = $this->_request->getParam('username');
                $password = $this->_request->getParam('password');
                // get the default db adapter
                $db = Zend_Db_Table::getDefaultAdapter();
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'user', 'username', 'password');
                //set the email and password
                $authAdapter->setIdentity($username);
                $authAdapter->setCredential(md5($password));
                $result = $authAdapter->authenticate();
                if ($result->isValid()) {
                    $auth = Zend_Auth::getInstance();
                    $storage = $auth->getStorage();
                    $storage->write($authAdapter->getResultRowObject(array('user_id', 'username', 'name', 'user_photo')));
                    $this->redirect('rss');
                    //var_dump($storage->read());
                } else {
                    $this->view->loginData = $this->loginForm;
                    echo '<font color="red"> Invalid user Data </fon>';
                }
            } else {
                $this->view->loginData = $this->loginForm;
            }
        } else {
            $this->redirect('user/index');
        }
    }

    public function logoutAction() {
        // action body
        Zend_Auth::getInstance()->clearIdentity();
        $this->redirect('user/login');
    }

}
