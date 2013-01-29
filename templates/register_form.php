<!--
  - register_form.php                                                        
  -                                                                          
  - HTML for register form, rendered by register.php                         
  - Modified from CS50 problem set 7 distibution code                        
  -                                                                          
  - Max Lu                                               
  -->

<div align="center">
    <a href="/"><img alt="Coordinate" src="img/logobigdarkred.gif"/></a>
    <form action="register.php" method="post">
        <fieldset>
            <div class="control-group">
                <input autofocus name="name" placeholder="Name" type="text"/>
            </div>
            <div class="control-group">
                <input autofocus name="email" placeholder="Email Address" type="text"/>
            </div>
            <div class="control-group">
                <input name="password" placeholder="Password" type="password"/><br/>
                <input name="confirmation" placeholder = "Confirm Password" type = "password"/>
            </div>
            <div class="control-group">
                <button type="submit" class="btn">Register</button>
            </div>
        </fieldset>
    </form>
    or <a href="login.php">log in</a> for an account
</div>
