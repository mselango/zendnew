<?php

class Application_Form_Student extends Zend_Form
{
    public function __construct($options = null) {
        parent::__construct($options);

        $this->setMethod('post');
        
        $studenid = new Zend_Form_Element_Hidden('id');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')->setRequired(true);
       
        $dept= new Zend_Form_Element_Text('dept');
        $dept->setLabel('Dept')->setRequired(true);
        
        $marks = new Zend_Form_Element_Text('marks');
        $marks->setLabel('Marks')->setRequired(true);
        
        $submit = new Zend_Form_Element_Submit('submit');
        
        $this->addElements(array( $studenid,$name,$dept,$marks,$submit));
    }
}