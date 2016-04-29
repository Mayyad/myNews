<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $username = new Zend_Form_Element_Text("username");
        $username->setRequired();
        $username->setLabel("user name : ");
        $username->setAttrib("class",  array("form-control","col-lg-9" ));
        $username->setAttrib("placeholder", "you username...");
        
        $password = new Zend_Form_Element_Password("password");
        $password->setRequired();
        $password->setAttrib("class",  array("form-control","col-lg-9" ));
        $password->setLabel("password");
        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $submit->setAttrib("value", "Login");
        
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','form-horizontal');
        $this->addElements(array($username ,$password , $submit));
        
    }


}

