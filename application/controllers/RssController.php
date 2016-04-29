<?php

class RssController extends Zend_Controller_Action
{

    private $rss_form = null;

    private $rss_model = null;

    private $authorization = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->authorization = Zend_Auth::getInstance();
           if (!$this->authorization->hasIdentity()) {
               $this->redirect('user/login');   
           }
        $this->rss_form = new Application_Form_Rss();
        $this->rss_model = new Application_Model_DbTable_Rss();
    }

    public function indexAction()
    {
        // action body
        $this->view->rss = $this->rss_form;
        $storage = $this->authorization->getIdentity();
        $loggedUserId = $storage->user_id;
        $user_rss = $this->rss_model->listRss($loggedUserId);
        $this->view->myrss = $user_rss;
    }

    public function addAction()
    {
        // action body
        $rss_data = $this->getRequest()->getParams();
        if ($this->getRequest()->ispost()) {
            if ($this->rss_form->isValid($rss_data)) {
                Zend_Uri::setConfig(array('allow_unwise' => true));
                $valid = Zend_Uri::check($rss_data['link']);
                if ($valid) {
                    
                    $storage = $this->authorization->getIdentity();   //get logged user data
                    $user_id = $storage->user_id;
                    $rss_data['user_id'] = $user_id;
                    $this->rss_model->addRss($rss_data);
                    $this->redirect('rss/index');
                    
                } else {
                    echo 'wrong url,, please Write a correct one';
                }
            }
        }
    }

    public function deleteAction()
    {

        $selectedRss = $this->getRequest()->getParams();
        $this->rss_model->DeleteRss($selectedRss['id']);
        $this->redirect('rss/index');
        
    }

    public function listAction()
    {
        // action body
        $storage = $this->authorization->getIdentity();
        $loggedUserId = $storage->user_id;
        $user_rss = $this->rss_model->listRss($loggedUserId);
        $this->view->rss = $user_rss ;
    }


}


