
   <!---<div id="site_content">	-->
     
<div id="login_form_error" class ="alert alert-error">  <!-- Dynamic -->
</div>
<form id="login_form" class="login"  method="POST" action="<?=site_url('api/login')?>">
    
   <div class="navbar-form">
        <label class="control-label">Login :</label>
        <div class="control">
            <input type="text" name="login" class="input-xlarge">
        </div>
    </div>    
        
    <div class="navbar-form">
        <label class="control-label">Password :</label>
        <div class="control">
            <input type="password" name="password" class="input-xlarge">
        </div>
    </div>
       <div class="login-submit">
      
            <button type="submit" value="login" class="login-button"> Login </button>
        
    </div>
    
  
    
</form>
     <section class="about">
    <p class="about-links">
      <a href="<?=site_url('/')?>" target="_parent">Back</a>
      <a href="http://www.cssflow.com/snippets/dark-login-form.zip" target="_parent">Download</a>
    </p>
    <p class="about-author">
      &copy; 2012&ndash;2013 <a href="http://thibaut.me" target="_blank">Thibaut Courouble</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://365psd.com/day/2-234/" target="_blank">Rich McNabb</a>
  </section>  
            
    

        
      <!-----------------------   KRAJ  FORME      ----------------------------->
        
  

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

   