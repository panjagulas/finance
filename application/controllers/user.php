<?php

class User extends CI_Controller {

    // -------------------------------------------------------------------------
    
    public function __construct(){
        parent::__construct();
        
        
             // when user go to login page session set user_id = 1
             // user data is $user_id ,set to 1 in login method
        $user_id = $this->session->userdata('user_id');
        
        if($user_id){
       
          $this->logout();
        }
        
            $this->load->model('user_model');
            $this->load->model('portfolios_model');
            $this->load->helper('url_helper');
            $this->load->helper('html_helper');  
        }
          
    // -------------------------------------------------------------------------
        
    /**
     *  Session configuration
     *  Set in config.php / $config = ['encryption_key'] = 'napisi bilo sta';
     *  Set in autoload.php / $autoload['libraries'] = array('session', 'database' etc...);
     *  or put into login metod $this->load->library('session');
     * 
     *  $_POST['name'] moze ali nije bezbedno
     *  input() regulise \r\n prazne nove redove i
     *  standazira text polja
     *  sprecava XSS atack
     *  $config.php / $config['global_xss_filtering'] = TRUE;  
     */
        
     public  function login($page = 'login_view', $id=NULL){
         if ( ! file_exists(APPPATH.'views/'.$page.'.php')){
                // Whoops, we don't have a page for that!
                show_404();
        }   
        $data = '';
        $this->load->view('header_view', $data);
            $this->load->view($page, $data);
            $this->load->view('footer_view', $data); 
         
        $login = $this->input->post('login');
        $password = $this->input->post('password');
        
        $this->load->model('user_model');     /////////////////
        
        $result = $this->user_model->get([
            'login' => $login,
            'password' => $password
        ]);
        
        $this->output->set_content_type('application_json');
        if($result){
            $this->session->set_userdata(['user_id'=> $result[0]['user_id']]);
            $this->output->set_output(json_encode(['result' => 1]));
         
           return false;
         }
             $this->output->set_output(json_encode(['result' => 0]));
    }
      
       //$this->load->library('session');
        //config/autoload.php/$autoload['libraries'] = array('database', 'session', 'itd...')
        
        // prosledjujem niz postavljam user_id TRUE na 1
        
        //$session = $this->session->all_userdata();
        //print_r($session);
            /*
            $this->session->set_userdata(['user_id' => 1]);
            $session = $this->session->all_userdata();
            print_r($session);        
            */
    
    
    //--------------------------------------------------------------------------
    
     public function index($page = 'yourwork_view', $id=NULL){
             if ( ! file_exists(APPPATH.'views/'.$page.'.php')){
                // Whoops, we don't have a page for that!
                show_404();
        }   
        $data = '';
            //$data['portfolios'] = $this->portfolios->getAll();
            //$data['users'] = $this->users->getAll();
        
              //$data['users'] = $this->users->get($id);
        
            
            $this->load->view('header_view', $data);
            $this->load->view($page, $data);
            $this->load->view('footer_view', $data);
    }  
    
    // -------------------------------------------------------------------------       
       
    public function logout(){
            $this->session->sess_destroy();
            //session_destroy();
            redirect('/');  // '/' vraca na pocetnu stranu 
       } 
       
    // -------------------------------------------------------------------------      

            
        
       
       
       
       
       
       
       
       
       
       
        
    // -------------------------------------------------------------------------
    /**
     *  @ param $user_id $_GET['user_id] = null; 
     *  @ param get(($_GET['user_id'] = 2));
     *  @ method $this->output->enable_profiler(true);
     *  @ show all data in background of Codeigniter 
     *  SELECT * FROM `users` WHERE `user_id` = 2 
     */
    public function test_get($user_id = null){
        $data = $this->user_model->get($user_id);
        print_r($data);
        $this->output->enable_profiler(true);
    }    
    
    // -------------------------------------------------------------------------
    /**
     *  @ method $this->output->enable_profiler(true);
     *  @ show all data in background of Codeigniter
     *  INSERT INTO `users` (`name`) VALUES ('Tester') 
     */
     public function test_insert(){
        $result = $this->user_model->insert([
            'name' => 'Tester'
        ]);
        print_r($result);
    }
    
    // -------------------------------------------------------------------------
    /**
      *  @ method $this->output->enable_profiler(true);
      *  @ show all data in background of Codeigniter
      *  UPDATE `users` SET `name` = 'Soso' WHERE `user_id` = 68 
     */
    
    public function test_update(){
        $result = $this->user_model->update([
            'name' => 'Soso'
        ], 68);
        print_r($result); 
    }
    
    // -------------------------------------------------------------------------
    
    public function test_delete($user_id){
        $result = $this->user_model->delete($user_id);
        print_r($result);
    }
    
    // -------------------------------------------------------------------------
      
        
        
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    // -------------------------------------------------------------------------
        
   
    
    // -------------------------------------------------------------------------
    
       
    
       
    public function projects($page = 'projects_view'){
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
    
   public function register($page = 'register_view'){
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
    
   public function yourwork($page = 'yourwork_view'){
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
    
}

