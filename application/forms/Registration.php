<?php

class Application_Form_Registration extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $name = new Zend_Form_Element_Text("name");
        $name->setRequired();
        //$name->addValidator(new Zend_Validate_Alpha());
        $name->setLabel("Name");
        $name->setAttrib("class", array("form-control","col-lg-9" ));
        $name->setAttrib("placeholder","Enter your name ");
        
        
        $username = new Zend_Form_Element_Text("username");
        $username->setRequired();
        //$username->addValidators();
        $username->setLabel("User Name : ");
        $username->addValidator(new Zend_Validate_Db_NoRecordExists(
            array(
                'table' => 'user',
                'field' => 'username'
            )
        ));
        $username->setAttrib("class", array("form-control","col-lg-9" ));
        $username->setAttrib("placeholder","Enter your user name ");
        
        
        
        $email = new Zend_Form_Element_Text("email");
        $email->setRequired();
        $email->setAttrib("class",array("form-control","col-lg-9" ));
        $email->addValidator(new Zend_Validate_EmailAddress());
        $email->addValidator(new Zend_Validate_Db_NoRecordExists(
            array(
                'table' => 'user',
                'field' => 'email'
            )
        ));
        $email->setlabel("Email:");
        $email->setAttrib("placeholder","Enter your Email");
        
        
        $password = new Zend_Form_Element_Password("password");
        $password->setRequired();
        $password->setLabel("Password");
        $password->setAttrib("class", array("form-control","col-lg-9" ));
        $password->addValidator(new Zend_Validate_StringLength(array('min' =>1, 'max' => 10)));
        
        $user_photo = new Zend_Form_Element_File("user_photo");
        $user_photo->setLabel("profile picture");
        $user_photo->setAttrib("class", array("form-control","col-lg-9" ));
        $user_photo->setAttrib('id','user-photo');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $submit->setAttrib("value", "add");
        
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','form-horizontal');
        $this->addElements(array($name , $username , $email , $password , $user_photo , $submit));
    }


}

