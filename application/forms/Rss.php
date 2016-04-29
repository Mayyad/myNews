<?php

class Application_Form_Rss extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $rss_title = new Zend_Form_Element_Text("title");
        $rss_title->setLabel("title");
        $rss_title->setRequired();
        $rss_title->setAttrib("class", array("form-control","col-lg-9" ));
        $rss_title->setAttrib("placeholder","Enter RSS title ");
        
        
        
        $rss_link = new Zend_Form_Element_Text("link");
        $rss_link->setLabel("Url");
        $rss_link->setAttrib("class", array("form-control","col-lg-9" ));
        $rss_link->setAttrib("placeholder","Enter RSS link ");
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $submit->setAttrib("value", "add");
        
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->setAttrib('action',"'.$this->baseUrl().'rss/add");
        $this->addElements(array($rss_title , $rss_link , $submit));
        
        
    }


}

