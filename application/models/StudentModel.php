<?php


class Application_Model_StudentModel {

    public function __construct() {
        $this->db = Zend_Registry::get("db");
    }

    public function getAllStudents() {

        $select = $this->db->select("*")->from("students")->order('id desc');

        return $select;
    }
    
    public function addStudent($data){
        
        unset($data['id']);unset($data['submit']);
        $this->db->insert("students",$data);
    }
    
    public function editStudent($id){
        
        $sql="select * from students where id =$id";
        $result= $this->db->fetchRow($sql);
        return $result;
    }
    
    public function updateStudent($data){
        unset($data['submit']);
        $id=$data['id'];
        $this->db->update("students",$data,"id=$id");
        
    }
   

}
