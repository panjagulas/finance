
<div id="register_form_error" class ="alert alert-error">  <!-- Dynamic -->
</div>
<form id="register_form" class="login"  method="POST" action="<?=site_url('api/register')?>">
    
    <div class="navbar-form">
        <label class="control-label">Login :</label>
        <div class="control">
            <input type="text" name="login" class="input-xlarge">
        </div>
    </div>
    
     <div class="navbar-form">
        <label class="control-label">Email :</label>
        <div class="control">
            <input type="text" name="email" class="input-xlarge">
        </div>
    </div>    
        
    <div class="navbar-form">
        <label class="control-label">Password :</label>
        <div class="control">
            <input type="password" name="password" class="input-xlarge">
        </div>
    </div>
    
    
    <div class="navbar-form">
        <label class="control-label">Re_Pass :</label>
        <div class="control">
            <input type="password" name="confirm_password" class="input-xlarge">
        </div>
    </div>
    
       <div class="login-submit">
      
            <button type="submit" value="login" class="login-button"> Login </button>
        
    </div>
     <section class="about">
    <p class="about-links">
      <a href="<?=site_url('/')?>">Back</a>
      <a href="http://www.cssflow.com/snippets/dark-login-form.zip" target="_parent">Download</a>
    </p>
    <p class="about-author">
      &copy; 2012&ndash;2013 <a href="http://thibaut.me" target="_blank">Thibaut Courouble</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://365psd.com/day/2-234/" target="_blank">Rich McNabb</a>
  </section>
    
    
</form>


<script type="text/javascript">
    //  $ oznaka za jquery 
    $(function(){
        
       $("#register_form_error").hide();
        
        // selektujem formin id, prosledjujem dogadjaj da sprecim
        // formu da se posalje preventDefault()
        // jer hocu da je prvo serijalizujem
       $("#register_form").submit(function(evt){
           evt.preventDefault();
           
        // pozivam atribut action forme 
       var url = $(this).attr('action');
        // serijalizujem zahtev i stavljam input zahteva u var postData
       //var postData = $(this).serialize();
       //slanje objekta umesto serializacije forme
       var postData = {
           "login":$("[name=login]").val(),
           "email":$("[name=email]").val(),
           "password":$("[name=password]").val(),
           "confirm_password":$("[name=confirm_password]").val(),
       }
       // POST-u prosledjujem parametre action url, serijalizaciju i callback funkciju
       $.post(url, postData, function(o){
           if (o.result == 1){
               window.location.href = '<?=site_url('api/yourwork')?>'; 
               alert('Welcome Register User');
           } else {
               // umesto alert('Invalid Login'); zelim MOJ alert
               $("#register_form_error").show();
               //alert('Invalid Register');
               var output = '<ul>';
               for(var key in o.error){
                   var value = o.error[key];
                   output += '<li>' + key + ': ' + value + '</li>';
               }
               output += '</ul>';
                $("#register_form_error").html(output);
           }
       }, 'json'); // sve ovo stavljam u JSON
       });
    });
</script>









    
	<!---<div id="site_content">	-->
            
            
            
       <!--------------------   REGISTER   F O R M A       ------------------------------    
	
  <form method="post" action="index.html" class="login">
      
    <p>
      <label for="login">Name:</label>
      <input type="text" name="name" id="login" value="name">
    </p>
      
    <p>
      <label for="login">Email:</label>
      <input type="text" name="login" id="login" value="name@example.com">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="4815162342">
    </p>
     
    <p>
      <label for="password">Re-Pass:</label>
      <input type="password" name="password" id="password" value="4815162342">
    </p>
    
    
    <p class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </p>

    <p class="forgot-password"><a href="index.html">Forgot your password?</a></p>
  </form>

  <section class="about">
    <p class="about-links">
      <a href="http://www.cssflow.com/snippets/dark-login-form" target="_parent">View Article</a>
      <a href="http://www.cssflow.com/snippets/dark-login-form.zip" target="_parent">Download</a>
    </p>
    <p class="about-author">
      &copy; 2012&ndash;2013 <a href="http://thibaut.me" target="_blank">Thibaut Courouble</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://365psd.com/day/2-234/" target="_blank">Rich McNabb</a>
  </section>

        
        ------------------------   KRAJ  FORME      ----------------------------->
        
        
        
        
      