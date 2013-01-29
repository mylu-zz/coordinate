<!--
  - login_form.php                                                           
  -                                                                          
  - HTML for login form, rendered by login.php                               
  - Modified from CS50 problem set 7 distibution code                        
  -                                                                          
  - Max Lu                                                
  -->

<div align="center">
    <a href="/"><img alt="Coordinate" src="img/logobigdarkred.gif"/></a>
    <form action="login.php" method="post">
        <fieldset>
            <div class="control-group">
                <input autofocus name="email" placeholder="Email Address" type="text"/>
            </div>
            <div class="control-group">
                <input name="password" placeholder="Password" type="password"/>
            </div>
            <div class="control-group">
                <button type="submit" class="btn">Log In</button>
            </div>
        </fieldset>
    </form>
    or <a href="register.php">register</a> for an account
</div>
