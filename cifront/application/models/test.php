<?php
class Test extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    public function mama(){
        echo "this is model";
        
        $this->load->database();
        $query = $this->db->query('SELECT * FROM test');
         
        foreach ($query->result() as $row)
        {
            echo $row->id;
            echo $row->a;
            echo $row->b;
        }
         
        echo 'Total Results: ' . $query->num_rows();
    }
    
    
}