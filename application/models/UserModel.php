<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Model_UserModel {

    public function __construct() {

        $this->db = Zend_Registry::get('db');
    }

    public function get_all_users() {

        $sql = 'SELECT * FROM users11 ';
        $result = $this->db->fetchAll($sql);
        return $result;
    }
    
    public function insert_user($data){
        
      //  print_r($data);exit;
        $this->db->insert("users11",$data);
    }
    
    public function list_user(){
        return $adapter = $this->db->select()->from('users11');   
    }

}
