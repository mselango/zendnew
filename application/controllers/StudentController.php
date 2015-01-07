<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StudentController extends Zend_Controller_Action {

    public function init() {
        $this->smodel = new Application_Model_StudentModel();
    }

    public function indexAction() {

        $page = $this->_getParam('page', 1);
        $res = $this->smodel->getAllStudents();

        $paginator = Zend_Paginator::factory($res);
        $paginator->setItemCountPerPage(2);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;
    }

    public function addAction() {

        $studentform = new Application_Form_Student();
        $this->view->form = $studentform;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($studentform->isValid($data)) {
                $this->smodel->addStudent($data);
                $this->redirect('student');
            }
        }
    }

    public function editAction() {

        $studentform = new Application_Form_Student();
        $edit_id = $this->getRequest()->getParam('id');
        $edi_val = $this->smodel->editStudent($edit_id);

        $studentform->populate(array('id' => $edi_val['id'],
            'name' => $edi_val['name'],
            'marks' => $edi_val['marks'],
            'dept' => $edi_val['dept']));
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($studentform->isValid($data)) {
                $this->smodel->updateStudent($data);
            }
        }


        $this->view->form = $studentform;
    }

    public function uploadAction() {
        $uform = new Application_Form_Upload();

        if ($this->getRequest()->isPost()) {
            $upload = new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination(APPLICATION_PATH . '/data/');

            try {
                // This takes care of the moving and making sure the file is there
                $upload->receive();
                // Dump out all the file info
                Zend_Debug::dump($upload->getFileInfo());
            } catch (Zend_File_Transfer_Exception $e) {
                echo $e->message();
            }
        }
        $this->view->form = $uform;
    }

}
