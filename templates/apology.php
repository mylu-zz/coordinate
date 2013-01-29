<!--
  - apology.php                                                              
  -                                                                          
  - Handles user error                                                       
  - Modified from CS50 problem set 7 distibution code                        
  -                                                                          
  - Max Lu                                                
  -->

<div align=center>
<a href="/"><img alt="Coordinate" src="img/logobigdarkred.gif"/></a>
<p class="lead text-error">
    Sorry!
</p>
<p class="text-error">
    <?= htmlspecialchars($message) ?>
</p>

<a href="/">Back</a>
</div>
