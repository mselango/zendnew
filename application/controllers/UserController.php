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

        $page = $this->_getParam('page',1);
        $data = $this->umodel->list_user(); // call Method
        // print_r($data);
        $paginator = Zend_Paginator::factory($data);
        $paginator->setItemCountPerPage(2);
        $paginator->setCurrentPageNumber($page);
        // print_r($paginator);
        $this->view->paginator = $paginator;
        // $this->view->form = $searchform;
    }

}
