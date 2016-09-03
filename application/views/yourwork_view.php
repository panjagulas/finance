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
  
<h1> OVO JE YOURWORK STRANA</h1>

 <?php
   
   if($symbol){
       foreach($symbol as $data){
        echo "<div class='button'; style='border: 2px solid rgba(250, 250, 250, 0.8);position:relative;float:left;border-radius: 5px;width:70px;background-color:light gray;padding:7px;margin:6px;'>";
        echo "<a href='{$data}'></a>";
	echo $data ."<br>" ;
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
     
     
     
     
     
     
<div id='register_form_error'>
<form  id="register_form" method="post" action="" class="login" >
 <p>
   <label for="login">Search :</label><br><br>
   <input id="login" type="text" name="symbol"  value="" placeholder="Enter symbol ...">
  </p> 
 
  <p class="login-submit"> 
      <button type="submit" class="login-button">Get Share Symbol</button>
   </p> 
<?php
    
$have = ($have_symbol == true)?"enabled":'';
if($is_login){
    
   echo"<div>";
   echo"<input id='login' type='text' name='shares_quant'  value='' placeholder='Enter kol ...'> ";
   echo "</div>"; 
   echo"<br>"; 
   
   
  echo "<div style ='float:left;border: 2px solid rgba(250, 250, 250, 0.8);border-radius: 5px'>";
  echo "<button>";
  echo "<input type='submit' form='register_form'  class='button' {$have} value='BUY'>";
  echo "</button>";
  echo "</div>";
  
  
  echo "<div style ='float:left;border: 2px solid rgba(250, 250, 250, 0.8);border-radius: 5px'>";
  echo "<button>";
  echo "<input type='submit' form='register_form'  class='button' {$have} value='SELL'>";
  echo "</button>";
  echo "</div>";
 
   echo "<div style ='float:left;border: 2px solid rgba(250, 250, 250, 0.8);border-radius: 5px'>";
  echo "<button>";
  echo "<input type='submit' form='register_form' class='button' {$have} value='SALDO'>";
  echo "</button>";
  echo "</div>"; 
  
 
}

?>	
  
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

   