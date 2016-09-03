<?php
/*
 * defaulte controller Home
 */
class Home extends CI_Controller{ 
    
   // -------------------------------------------------------------------------- 
    
     public function __construct(){
        parent::__construct();
            $this->load->helper('url_helper');//Call to undefined function base_url() 
            $this->load->helper('html_helper');
        }
        
   // --------------------------------------------------------------------------
        /*
         * defaulte controller, defaulte method and defaulte page
         */
        
        public function index($page = 'home_view'){   
             if ( ! file_exists(APPPATH.'views/'.$page.'.php')){
                // Whoops, we don't have a page for that!
                show_404();
        }
            $data = '';
            $this->load->view('header_view', $data);
            $this->load->view($page, $data);
            $this->load->view('footer_view', $data);
    }
  
    // -------------------------------------------------------------------------
    
        public function register( $page = 'register_view'){
                 if ( ! file_exists(APPPATH.'views/'.$page.'.php')){
                // Whoops, we don't have a page for that!
                show_404();
        }
         $data = null;   
         $this->load->view('header_view');
         $this->load->view($page,$data);
         $this->load->view('footer_view');
        }   
        
    // -------------------------------------------------------------------------  
    
    public function login( $page = 'login_view'){
                 if ( ! file_exists(APPPATH.'views/'.$page.'.php')){
                // Whoops, we don't have a page for that!
                show_404();
        }
         $data = null;   
         $this->load->view('header_view');
         $this->load->view($page,$data);
         $this->load->view('footer_view');
        }   
        
    // -------------------------------------------------------------------------    
        
public function test(){
       
    }
    
    
}


    /************   INSERT     *****************
     * 
     *   $this->db->insert('users', [
         'name' => 'makson',
         'email' => 'makson@com'
           ]);
     * 
     * ili
     * 
     *   $data = array(
        'name' => 'srdjan',
        'balance' => '10000'
          );
     $this->db->insert('users', $data);
     */

    /************   UPDATE     *****************
     * 
     * 
     *  $data = array(
        'name' => 'brdjan',
        'balance' => '5000'
         );
        $this->db->where(['user_id' => 65]);
        $this->db->update('users', $data);
     * 
     *  ili
     * 
     *  $this->db->where(['user_id' => 68]);
        $this->db->update('users', [
        'name' => 'mrdjan',
        'balance' => '7000'
        ]);
     * 
     */
    
    /************   SELECT     *****************
     *
     *  $q = $this->db->get($this->table);
     *  print_r($q->result());
    
     *  ili ovako
     *  $q = $this->db->get('users');
     *  print_r($q->result());
     * 
     */
    
    /************   SELECT WHERE     ************ 
     *
     *  public function get($id){
     *  $q = $this->db->get_where($this->table,array['user_id' => $id]);  
     *  print_r($q->result());
        }
     *
     * ili ovako 
     * 
     *  $q = $this->db->get_where('users', ['user_id' => 1]);   
                print_r($q->result());
     *
     *
     * ili ovo  
     * 
     *      $this->db->where(['user_id => 1']);
     *  $q = $this->db->get('users');
     *         print_r($q->result());
     */
    
    /************   ORDER_BY     *****************
     *  
     *  $this->db->order_by('user_id DESC');
     *  $q = $this->db->get('users');
     *  print_r($q->result());
     */
    
    /************   SELECT ORDER_BY     *****************
     * 
     * SELECT user_id, name FROM users
     * ORDER_BY user_id DESC
     * 
     * 
     *  $this->db->select('user_id, name');
     *  $this->db->order_by('user_id DESC');
     *  $q = $this->db->get('users');
     *  print_r($q->result()); 
     * 
     * ili
     * 
     *  $this->db->select('user_id, name');
     *  $this->db->from('users');
     *  $this->db->order_by('user_id DESC');
     *  $q = $this->db->get();
     *  print_r($q->result()); 
     */

    /************   DELETE    *****************
     * 
     *  $this->db->delete('users', ['user_id' => 63]);
     * 
     *  ili
     * 
     *  $this->db->where(['user_id' => 67]);
     *  $this->db->delete('users');
     *
     */

    /************   METHOD CUSTOM CHANGE    *****************
       * 
       *   public function test(){
           $this->db->select('user_id', 'name')
                     ->from('users')
                     ->order_by('user_id DESC');
          $q = $this->db->get();
          print_r($q->result());
            }
      */
  
      
    

