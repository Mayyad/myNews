<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

    function addUser($data){
        
        if (isset($data['module'])){
            unset ($data['module']);
        }
        if (isset($data['controller'])){
            unset ($data['controller']);
        }
        if (isset($data['action'])){
            unset ($data['action']);
        }
        
        if (isset($data['submit'])){
            unset ($data['submit']);
        }
        
        if (isset($data['MAX_FILE_SIZE'])){
            unset ($data['MAX_FILE_SIZE']);
        }
        
        $data['password'] = md5($data['password']);
        $this->insert($data);
    }
        
}

