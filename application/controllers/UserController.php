<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        $this->umodel = new Application_Model_UserModel();
    }

    public function indexAction() {

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $this->umodel->insert_user($data);
            $this->redirect('/user/list');
        }
    }

    public function listAction() {

        $list = $this->umodel->get_all_users();
        $this->view->userList = $list;
    }

    public function listuserAction() {

        $page = $this->_getParam('page', 1);
        $data = $this->umodel->list_user(); // call Method
        $paginator = Zend_Paginator::factory($data);
        $paginator->setItemCountPerPage(2);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;
        // $this->view->form = $searchform;
    }

    public function loginAction() {

        $loginform = new Application_Form_Login();
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($loginform->isValid($data)) {
                $result = $this->umodel->checkLogin($data);
                $authNamespace = new Zend_Session_Namespace('Zend_Auth');
                $authNamespace->name = $result['username'];
            }
        }
        $this->view->form = $loginform;
    }

    public function mailAction() {
        
        $config = array('ssl' => 'tls', 'port' => 587,'auth' => 'login',
            'username' => 'testmail5210@gmail.com',
            'password' => 'CGvak123');

        $transport = new Zend_Mail_Transport_Smtp('smtp.googlemail.com', $config);
        Zend_Mail::setDefaultTransport($transport);
        
        $mail = new Zend_Mail();
        $mail->setBodyText('This is the text of the mail.');
        $mail->setFrom('admin@gmail.com', 'Admin');
        $mail->addTo('elangovan@cgvakindia.com', 'Elango');
        $mail->setSubject('TestSubject');
        $mail->send($transport);
        exit;
    }

}
