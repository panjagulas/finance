<?php

class Portfolios_model extends CI_Model {

// -----------------------------------------------------------------------------
    
public function get($user_id = null){
    if ($user_id === null){
        $q = $this->db->get('portfolios');
        } elseif (is_array($user_id)){
            $q = $this->db->get_where('portfolios', $user_id);
        }
        else {
            $q = $this->db->get_where('portfolios',['user_id' => $user_id]);
        }
        
        return $q->result_array();
    }  
    
// -----------------------------------------------------------------------------        

public function get_user_portfolio($user_id = null){
    if ($user_id === null){
        $q = $this->db->get('portfolios');
        } elseif (is_array($user_id)){
            $q = $this->db->get_where('portfolios', $user_id);
        }
        else {
            $q = $this->db->get_where('portfolios',['user_id' => $user_id]);
        }
        
        return $q->result_array();
    }  
    

// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------    
    
    
public function update($data, $user_id){
          $this->db->where(['user_id' => $user_id]);
          $this->db->update('users', $data);
          return $this->db->affected_rows();
    }  
       
}


    
    
    
    
    
    
    

/*
$obj = new Master;
 $obj->update(290);
*/
/*
  $object = new Master;
    $object->insert();   
*/

