<?php

class Application_Model_DbTable_Rss extends Zend_Db_Table_Abstract
{

    protected $_name = 'rss';

    function addRss ($data){
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
        
        $this->insert($data);
    }
    
    function listRss($user_id){
        
        $query = $this->select();
        $query->where('user_id'.'='.$user_id);
        $data = $this->fetchAll($query)->toArray();
        return $data ;
        
    }
    
    function DeleteRss($id){
        
        $where = $this->getAdapter()->quoteInto('rss_id = ?', $id);
        $this->delete($where);
        
    }

}

