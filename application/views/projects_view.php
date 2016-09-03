
<style>
    .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 4px 21px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px 1px;
    cursor: pointer;
    
}
    </style>
   
  <div class="sidebar_container1 "   >          		
    <div class="sidebar1" >
        <div class="sidebar_item1"   > <br>
           
    
           <!-- Start of Yahoo! Finance code -->
 <h1> OVO JE PROJECT STRANA</h1>
 
 
 <?php    

if(($this->input->post('tb_share',true))){
 if(!empty($shares)){
        foreach($shares as $res){
          echo "<div class='sidebar1'; style='border: 2px solid black;  border-radius: 5px;width:170px;background-color:light gray;padding:7px;margin:6px;'>";
          ?> <a href =''> <?=$res['symbol']. '   = kol  ' .$res['shares'] ?> </a>
          <?php     
              echo "</div>"; 
            }
        }
    }
// get the list of holdings for user
    if(!empty($res)){
       $arr = array();
          array_push($arr, $res);
             return $arr;
    }
?>
      
     
             </div><!--close sidebar_item--> 
        </div><!--close sidebar-->  
        </div><!--close sidebar_container--> 
        
 <?php
   
    if($symbol){
       foreach($symbol as $data){
        echo "<div class='button'; style='border: 2px solid rgba(250, 250, 250, 0.8);float:left;border-radius: 5px;width:250px;background-color:light gray;padding:7px;margin:6px;'>";
        echo "<a href='{$data}'></a>";
	echo $data;
	echo "</a>";
	echo "</div>"; 
    }   // var_dump($symbol);    
}
?>
              
 
   
<div class="sidebar_container">          		
    <div class="sidebar">
        <div class="sidebar_item"> <br>
           <!-- Start of Yahoo! Finance code -->
<iframe allowtransparency="true" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" 
        src="http://badge.finance.yahoo.com/instrument/1.0/INTL,GE,GOOGL,YHOO,MSFT,AAPL,AMD,IBM/badge;quote/HTML?AppID=Ntm8mRfYxQrRiQM.HC8Bwthc19gr&sig=4Nzw3z8hEqDmSQOmgrmqMUwBOqo-&t=1436706235020" 
        width="200px" height="706px"><a href="http://finance.yahoo.com">Yahoo! Finance</a><br/>
        <a href="http://finance.yahoo.com/q?s=INTL">Quote for INTL</a></iframe>  
        </div><!--close sidebar_item--> 
        </div><!--close sidebar-->  
        </div><!--close sidebar_container-->
     
        <div id='register_form_error'><br></br>
<form  id="register_form" method="post" action="" class="login" >
 <p>
   <label for="login">Search :</label><br><br>
   <input id="login" type="text" name="symbol"  value="" placeholder="Enter symbol ...">
  </p> 
      <p class="login-submit"> 
      <button type="submit" class="login-button">Get Share Symbol</button>
       </p> 
   
 <div>
  <input id='login' type='text' name='shares'  value='' placeholder='Enter kol ...'>
  </div>
  <br> 
   
   
  <div style ='float:left;border: 2px solid rgba(250, 250, 250, 0.8);border-radius: 5px'>
   <button>
  <input type='submit' form='register_form' name='tb_buy' class='button' {$have} value='BUY'>
  </button>
  </div>
  
  <div style ='float:left;border: 2px solid rgba(250, 250, 250, 0.8);border-radius: 5px'>
  <button>
  <input type='submit' form='register_form'   name ='tb_sell' class='button' {$have} value='SELL'>
  </button>
  </div>
 
 <div style ='float:left;border: 2px solid rgba(250, 250, 250, 0.8);border-radius: 5px'>
     <button>
     <input type ="submit" form='register_form'   name="tb_share" class='button' {$have} value='SALDO'>
 </button>
 </div>
  
  
  </form> 
	
      
   

     </div>

      <div><br style="clear:both"/><br/>
    </div>
  <div class="col-md-4 col-md-offset-1" style="float:left">
 </div>    
     
 
<script type="text/javascript">
    //  $ oznaka za jquery 
    $(function(){
        
       $("#login_form_error").hide();
        
        // selektujem formin id, prosledjujem dogadjaj da sprecim
        // formu da se posalje preventDefault()
        // jer hocu da je prvo serijalizujem
       $("#login_form").submit(function(evt){
           evt.preventDefault();
           
        // pozivam atribut action forme 
       var url = $(this).attr('action');
        // serijalizujem zahtev i stavljam input zahteva u var postData
       var postData = $(this).serialize();
       // POST-u prosledjujem parametre action url, serijalizaciju i callback funkciju
       $.post(url, postData, function(o){
           console.log(o);
           if (o.result === 1){
             window.location.href = '<?=site_url('api/yourwork')?>'; 
               alert('Good login');
           } else {
               // umesto alert('Invalid Login'); zelim MOJ alert
               $("#login_form_error").show();
               //alert('Invalid Login');
               var output = '<ul>';
               for(var key in o.error){
                   var value = o.error[key];
                   output += '<li>' + key + ': ' + value + '</li>';
               }
               output += '</ul>';
                $("#login_form_error").html(output);
           }
       }, 'json'); // sve ovo stavljam u JSON
       });
    });
</script>

   