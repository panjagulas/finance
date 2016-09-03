 <?php

class User_model extends CI_Model{
// ------------------------------------------------------------------------------
/**
 * @usage:
 * All records:   $this->user_model->get();
 * Single record: $this->user_model->get(2);
 * return:  [0] => stdClass Object 
*/
      
public function get($user_id = null){
    if ($user_id === null){
        $q = $this->db->get('users');
        } elseif (is_array($user_id)){
            $q = $this->db->get_where('users', $user_id);
        }
        else {
            $q = $this->db->get_where('users',['user_id' => $user_id]);
        }
        return $q->result_array();
    }
// -------------------------------------------------------------------------
    /**
     * @param type array $data
     * @usage $result = $this->user_model->insert(['name' => 'Tester'])
     * insert_id(); return allways inserted id
     */
    
    public function insert($data){
          $this->db->insert('users', $data);
          return $this->db->insert_id();
    }
    
    // -------------------------------------------------------------------------
    /**
     * 
     * @param type $data
     * @param type $user_id
     * @return type koliko ima promena 
     * @usage $result = $this->user_model->update([ 'name' => 'Hojo'], 68);
     */
    
    public function update($data, $user_id){
          $this->db->where(['user_id' => $user_id]);
          $this->db->update('users', $data);
          return $this->db->affected_rows();
    }
    
    // -------------------------------------------------------------------------
    /**
     * 
     * @param type $user_id
     * @return type koliko ima promena
     * @usage $this->user_model->delete(80);
     */
    
    public function delete($user_id){
         $this->db->delete('users', ['user_id' => $user_id]);
         return $this->db->affected_rows();
    }
    
    // -------------------------------------------------------------------------
    
    
    
    
 /*   
    private $table = 'users';
    public $id = 'id';
    
    public function __construct(){
           $this->load->database();
        }
       
        // get All users form database
        public function getAll() {
           $query = $this->db->get($this->table);
           return $query->result();
        }
        // get user_id from database
        public function get($id){
            $query = $this->db->get_where($this->table, $this->id = $id);
            return $query->row();
            
     }
  * 
  */
}
