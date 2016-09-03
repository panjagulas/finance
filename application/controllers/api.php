<?php

/*
 * Umesto da imam Users ~test controller koji ima samo pristup logici bolja opcija je da
 * koristim ovaj controller i AJAX pozive ka bazi podataka. 
 * Necu da brisem User controller samo cu da ga oznacim kao ~test controler 
 */

class Api extends CI_Controller{
    
    // ------------------------------------------------------------------------------

/*
 * Za razliku od ~test controller ovde ne zelim da u konstruktoru imam bilo kakav metod
 * za pozivanje ako mi ne treba. Zato logout() ne zelim ovde vec ga koristim samo ako 
 * imam logovanog korisnika. Koristim RE-Factoring
 */
    
    public function __construct() {
    parent::__construct();
          // when user go to login page session set user_id = 1
             // user data is $user_id ,set to 1 in login method
        $user_id = $this->session->userdata('user_id');
    /*
     * $this->load->model('user_model');
     * Ne zelim ovde jer necu da svaki put konstruisem usera kada se ucitava klasa
     * Metod user_model() pozivam direktno u kodu neposredno pre upita
     */
    $this->load->helper('url_helper');
    $this->load->helper('html_helper'); 
    $this->load->model('portfolios_model');
    $this->load->model('user_model');
    $this->load->library('session');
    }
    
    // ------------------------------------------------------------------------------
    
    private function _require_login(){
        
         //  if($user_id)   vidi u dashboard controleru u __construct()
         if($this->session->userdata('user_id') == false){
             /*
              * Ne zelim ni ovo u konstruktoru vec samo ako smo ulogovani
              * Posto je ovo AJAX ne treba mi logout() metod vec samo return FALSE
              * $this->logout();
              */
            $this->output->set_output(json_encode(['result' => 0, 'error' => 'You are not authorized!']));
            return false;
         }
    }

// ------------------------------------------------------------------------------
    
     public function _is_login(){
      
         if($this->session->userdata('user_id') == false){
            return false;
         }
         return true;
    }
    
// -------------------------------------------------------------------------------

public  function login(){
    $login = $this->input->post('login');
    $password = $this->input->post('password');
  //  $this->load->model('user_model');    definisao  u __construct()
       $result = $this->user_model->get([
            'login' => $login,
            'password' => hash('sha256', $password .SALT) 
        ]);
        $this->output->set_content_type('application_json');
            if($result){
               $this->session->set_userdata(['user_id' => $result[0]['user_id']]);
               $this->output->set_output(json_encode(['result' => 1]));
               return false;
        }
     
        $this->output->set_output(json_encode(['result' => 0]));
        $this->form_validation->set_rules('login', 'Login', 'required|is_unique[users.login]');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
            if($this->form_validation->run() == false){
               $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
               return false;  //exit(); samo prekida ne vrace  nista
            }
         
         
        }
 
// ------------------------------------------------------------------------------    
    
    public  function register(){
        
        $this->output->set_content_type('application_json');
       
        $this->form_validation->set_rules('login', 'Login', 'required|is_unique[users.login]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm_Password', 'required|matches[password]');
        if($this->form_validation->run() == false){
            $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
            return false;  //exit(); samo prekida ne vrace  nista
        }
        
        $login = $this->input->post('login');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        
        
  //    $this->load->model('user_model');     definisao u __construct();
        
        $user_id = $this->user_model->insert([
            'login' => $login,
            'password' => hash('sha256', $password . SALT),
            'email'  => $email,
            'balance' => 10000
         ]);
        if($user_id){
            $this->session->set_userdata(['user_id'=> $user_id]);
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
         }
            $this->output->set_output(json_encode(['result' => 0, 'error' => 'User Not Created']));    
            
    }
    
     // -------------------------------------------------------------------------
       
    
// -------------------------------------------------------------------------
/**
* 
* @param type $page
*/
public function yourwork( $page = 'yourwork_view',$data=null){
   $this->load->model('portfolios_model');
    $is_login = $this->_is_login(); 
        if ( ! file_exists(APPPATH.'views/'.$page.'.php')){
             // Whoops, we don't have a page for that!
              show_404();
        }
    
    $this->output->set_content_type('application_json');
    $symbol = $this->get_quote_data($this->input->post('symbol',true));
    $data['symbol'] = $symbol;
    
    $have_symbol = false;
    $data['have_symbol'] = $have_symbol;
    $data['is_login'] = $is_login; 
      
    $this->load->view('header_view');
    $this->load->view($page,$data);
    $this->load->view('footer_view');
     
    }   

// ------------------------------------------------------------------------- 
    
public function projects( $page = 'projects_view',$data=null){
   
    if(!$this->_is_login()){
         redirect('/');
    } 
    if ( ! file_exists(APPPATH.'views/'.$page.'.php')){
         // Whoops, we don't have a page for that!
          show_404();
    }
    
    $symbol = $this->get_quote_data($this->input->post('symbol',true));
    $data['symbol'] = $symbol;
    
    /**************************************************************************/
    $user_id = $this->session->userdata('user_id');
    $shares = $this->portfolios_model->get_user_portfolio($user_id);
    $data['shares'] = $shares;
    /**************************************************************************/
    
    $buy = $this->buy_shares($user_id);
    
    /**************************************************************************/
    
    $sell = $this->sell_shares($user_id);
    
    /**************************************************************************/
    
    $have_symbol = false;
    $data['have_symbol'] = $have_symbol;
    $data['is_login'] = $this->_is_login(); 
      
    $this->load->view('header_view');
    $this->load->view($page,$data);
    $this->load->view('footer_view');
     
    }   

    
// -------------------------------------------------------------------------      
    
    
    // ------------------------------------------------------------------------------
    /*
     *$this-> _require_login(); ako nisam ulogovan nista ne moze da se koristi
     * od ovih metoda. Zato sam radio posebnu metodu private  _require_login()
     * da bi je ovde koristio preko AJAX-a.
     */
    
    public function create_todo(){
       $this-> _require_login();
}
  
        
   
     
    
    
    // ------------------------------------------------------------------------------
    
    public function update_todo(){
        if(!$this-> _require_login())
        $todo_id = $this->input->post('todo_id');
    }
    
    // ------------------------------------------------------------------------------
    
    public function delete_todo(){
        $this-> _require_login();
        $todo_id = $this->input->post('todo_id');
    }
    
    // ------------------------------------------------------------------------------
    
    public function create_note(){
        $this-> _require_login();
    }
    
    // ------------------------------------------------------------------------------
    
    public function update_note(){
        $this-> _require_login();
        $note_id = $this->input->post('note_id');
    }
    
    // ------------------------------------------------------------------------------
    
    public function delete_note(){
        $this-> _require_login();
        $note_id = $this->input->post('note_id');
    }
    
   // ------------------------------------------------------------------------------
    
      //--------------------------------------------------------------------------
    
     public function index($page = 'home_view', $id=NULL){
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
    
    //--------------------------------------------------------------------------  
		
/**
 * get_yahoo_api and read file
 * metoda dobavlja berzanske podatke sa yahoo servera 
 * @param string $symbol oznaka kompanije sa kojom se trguje na berzi
 * @return array ovo je niz dobijenih podataka sa yahoo servera
 */
public function get_quote_data($symbol=null){
    $result = array();
    $url = "http://download.finance.yahoo.com/d/quotes.csv?s={$symbol}&f=sl1n&e=.csv"; 
    $handle = fopen($url, "r");
    if($handle){
	if ($row = fgetcsv($handle)) 
          if (isset($row[1])){
	     $result = array("co_symbol" => $row[0],"last_price" => $row[1],"co_name" => $row[2]);
	      fclose($handle);
               return $result;	
            }
        }
} 
//--------------------------------------------------------------------------

/**
 * get_user_portfolio() - Method in portfolios_model
 * get_user_shares() - Get portfolio for specified userid
*/
public function get_user_shares($userid = null ){
   $_GET['userid'] = $userid;  
    $this->output->set_content_type('application_json');
    $shares = $this->portfolios_model->get_user_portfolio($this->input->post('tb_share',true));
    
    
  //  print_r($shares);
 /*   
    if(!empty($shares)){
        foreach($shares as $res){
          echo "<div class='button'; style='border: 2px solid black;border-radius: 5px;width:170px;background-color:light gray;padding:7px;margin:6px;'>";
          ?> <a href =''> <?=$res['symbol']. '   = kol  ' .$res['shares'] ?> 
          <?php     
              echo "</div>"; 
            }
        }
// get the list of holdings for user
    if(!empty($res)){
       $arr = array();
          array_push($arr, $res);
             return $arr;
    }
  
  */
}
//------------------------------------------------------------------------------
/**
 * dobavlja trenutno stanje novca korisnika
 * @param $userid (int)
 * @return  [0] => stdClass Object 
 */
public function get_user_balance($userid = null) { 
    // $this->load->model('user_model');       definisao u construct();
    // check balance
    $_GET['userid'] = $userid;
       $balance = $this->user_model->get($userid);
       echo $balance[0]['balance'];
      //print_r($balance);
        return $balance;
    }
   
//------------------------------------------------------------------------------
/**
 * metoda za kupovinu akcija
 * @param $userid int 
 * @param $symbol oznaka kompanije sa kojim se trguje na berzi
 * @param $shares oznaka za kolicinu akcija
 * @return boolean
 */   
public function buy_shares($userid=null) { 
  // $_GET['user_id']=$userid ;
     $is_login = $this->_is_login();
     if(!empty($this->input->post('tb_buy',true))){
        $symbol = $this->input->post('symbol',true);
        $shares = $this->input->post('shares',true);
        $handle = $this->get_quote_data($symbol);
     
        if(!empty($handle)){
              $price = $handle['last_price']*$shares;
	          echo "<script type='text/javascript'>alert('$price');</script>";
// check if has required balance
        $user = $this->user_model->get($userid);
       // var_dump($user);
           if($user){
               if($price > $user[0]['balance']){
		   echo 'You have got less balance = $'.$user[0]['balance']. ' but you need $' .$price;
		       return false;
	    } 
        }
    }
// buy the shares
//$symbol = strtoupper($symbol);
if(!empty($price)){
    $conn = $this->db->trans_start();
        if($price === $this->input->post('symbol')){
            /* ne radi update  vec unoci svaku akciju posebno. Tako mozemo da znamo kada je kupljena*/
             $query = $this->db->query("UPDATE portfolios SET shares = shares + '{$shares}' WHERE user_id = '{$userid}' AND symbol ='{$symbol}'");
            }
            $query = $this->db->query("INSERT INTO portfolios (share_id, symbol, shares, quote_date, user_id) VALUES ('','{$symbol}','{$shares}','','{$userid}')");
            $query = $this->db->query("UPDATE users SET balance = balance - '{$price}' WHERE user_id = '{$userid}'");
        
	$this->db->trans_complete();
             if ($this->db->trans_status() === FALSE){
                 log_message('error', 'Transaction false.');
           }     
             else{
            log_message('debug', 'Transaction correctly set'); 
           }
            log_message('info', 'Transaction has to be completed.');
	}
}
}
//------------------------------------------------------------------------------

public function sell_shares($userid=null, $symbol=null){ 
    
  $is_login = $this->_is_login(); 
  if(!empty($this->input->post('tb_sell',true))){
    $symbol = $this->input->post('symbol',true);
    $shares = $this->input->post('shares',true);
    $handle = $this->get_quote_data($symbol);
      
    
 // calculate price of shares to be sold
    if(!empty($handle)){
        $price = $handle['last_price']*$shares;
           //print_r($price);
        echo "<script type='text/javascript'>alert('$price');</script>";
        
    if(!$price){
        echo  "Unable to access data from net";
	  return false;
        }
    }
// sell shares
//$symbol = strtoupper($symbol);
   
$conn = $this->db->trans_start();
$shares = true;
    if($price > $this->input->post('shares')){
         $query = $this->db->query("SELECT shares FROM portfolios WHERE user_id='{$userid}' AND symbol='{$symbol}' AND shares >= {$_POST['shares']}");
               $row = $query->result_array();
                      print_r($row);
    $query = $this->db->query("UPDATE  portfolios SET shares = shares - {$_POST['shares']} WHERE user_id='{$userid}' AND symbol='{$symbol}' AND shares >= {$_POST['shares']}");  

// prodate akcije ukupna cena(balance)
    if($row[0]>($this->input->post('shares'))) {
            $query = $this->db->query("UPDATE users SET balance = balance + '{$price}' WHERE user_id = '{$userid}'");
                 }
        }
            $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE){
                    log_message('error', 'Transaction false.');
                    }else{
                    log_message('debug', 'Transaction correctly set'); 
               }
                    log_message('info', 'Transaction has to be completed.');
	}
}    
//------------------------------------------------------------------------------  
}
        
                   


 