<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Form_Login extends Zend_Form{
    
    public function __construct($options = null) {
        parent::__construct($options);
        
        $this->setMethod('post');
        
        $name=new Zend_Form_Element_Text("name");
        $name->setLabel("Username")->setRequired(TRUE);
        
        $password = new Zend_Form_Element_Password("password");
        $password->setLabel("password")->setRequired(TRUE);
        
        $captcha  = new Zend_Form_Element_Captcha('foo', array(
    'label' => "Please verify you're a human",
    'captcha' => array(
        'captcha' => 'Figlet',
        'wordLen' => 6,
        'timeout' => 300,
    ),
));
        
        
        $submit = new Zend_Form_Element_Submit("submit");
        
        $this->addElements(array($name,$password,$captcha,$submit));
        
    }
    
    
}