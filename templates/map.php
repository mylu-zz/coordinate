<!--
  - map.php                                                                  
  -                                                                          
  - HTML creates main buttons and declares placeholder divs that will        
  - be filled by javascript functions.                                       
  -                                                                          
  - Max Lu                                                
  -->


<div align="left">
    <br>
    <div class=span4>
        <a href="/"><img align="left" alt="Coordinate" src="img/logodarkred.gif"/></a>
    </div>
    <br>
    <div class=span7>
    </div>
    <div class=span2>
        <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <?php print($name); ?>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="help.php">Help</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</div>
<hr align="center" width="100%">

<div class="span3" style=" width=110%; height: 80%; overflow-y: scroll; overflow-x: hidden;"> 
        <div id="coordinate"></div>
        <div class="btn-group" id = "menu">
            <a href="#" class="btn btn-mini" id="inbox">Coordinates</a> 
            <a href="#" class="btn btn-mini" id="share">Share</a>
            <a href="#" class="btn btn-mini" id="request">Request</a>
            <a href="#" class="btn btn-mini" id="contacts">Contacts</a>
        </div>
        <br><br>
        <div id="option">
        </div>
        <div id = "contactinfo">
        </div>
</div>
<div class="span10" id="map_canvas" style="height:80%">
</div>

