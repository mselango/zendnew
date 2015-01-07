<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Form_Upload extends Zend_Form {

    public function __construct($options = null) {

        parent::__construct($options);
        
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setMethod('post');
        
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('File to Upload:')->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Upload File');
        
        $this->addElements(array($file, $submit));
    }

}
