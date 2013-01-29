<!--
  - showhelp.php                                                             
  -                                                                          
  - HTML from help page, rendered by help.php                                
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
    <!-- dropdown menu button -->
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
<div class=span1>
</div>
<div class=span11>
    <br><font size="6"><b>Welcome to Coordinate.</b></font><img alt="marker" src="/img/marker.png"/><br>
    Coordinate is a website created by Max Lu and Olivia Angiuli that lets users send and receive
    snapshots of their locations to their friends. Users can choose to send their location to a
    friend at any time, or can request that another user send them their location. This website
    enables people to easily locate their friends and facilitate meetups. Coordinate can also be
    used to take attendance in large classes or enable parents to ensure the safety of their children. 
    It also acts as a social medium through which users can send personalized messages along with
    their location.
    <br><br><font size="4"><b>Registering for Coordinate</b></font><br>
    If you do not have an account, you must first register for an account. You can do so by clicking
    the "register" link at the bottom of the login page:
    <img alt="register" src="/img/register.png"/><br>
    On the register form, simply fill out your name, email address, and password. Then click Register. You
    will automatically be registered and logged in.    <b></b>
    <br><br><font size="4"><b>Logging into Coordinate</b></font><br>
    Enter the email address and the password with which you registered, and click "Log In". You will be
    redirected to the home page.
    <br><br><font size="4"><b>Adding Contacts</b></font>
    <br>In order to share and request coordinates with people, you must first add them as contacts.
    <ul>
        <li>First, click on the "Contacts" tab on the left panel of the screen.</li>
    </ul>
    <br><img alt="contacts" src="/img/contacts.png"/>
    <ul>
        <li>Click on the red "Add Contacts" button.</li>
        <li>Enter the email address of the person you'd like to add as a contact.</li>
        <li>Click "Add". You can only add contacts who are already registered for Coordinate.</li>
        <li>The new contact will appear on your contact list! To view his/her details, simply click on his/her name.</li>
    </ul>
    <br><font size="4"><b>Deleting Contacts</b></font>
    <br>No longer want to be contacts with someone? No problem.
    <ul>
        <li>Click on their name under the "Contacts" tab.</li>
        <li>On the bottom of the page, where their details appear, click the gray "Delete" button.</li>
    </ul>
    <br><font size="4"><b>Sharing Your Own Coordinates</b></font>
    <ul>
        <li>First, click on the "Share" tab on the left panel of the screen.</li>
    </ul>
        <br><img alt="share" src="/img/share.png"/>
    <ul>
        <li>On the drop-down menu, select the contact with whom you'd like to share your coordinate.   
        If the person does not appear, you must first add them as a contact. See the "Adding
        Contacts" section above. </li>
        <li>Enter an optional message in the textbox.</li>
        <li>Click "Share your Coordinate". You have just shared your location!</li>
    </ul>
        <br><font size="4"><b>Requesting Others' Coordinates</b></font>
    <ul>
        <li>First, click on the "Request" tab on the left panel of the screen.</li>
    </ul>
        <br><img alt="request" src="/img/request.png"/>
    <ul>
        <li>On the drop-down menu, select the contact whose coordinate you want.  
        If the person does not appear, you must first add them as a contact.
        See the "Adding Contacts" section above.</li>
        <li>Enter an optional message in the textbox.</li>
        <li>Click "Request a Coordinate". They will receive a request from you under the "Coordinates" tab.</li>
    </ul>
    <br><font size="4"><b>Viewing your Shares and Requests</b></font>
    <ul>
        <li>First, click on the "Coordinates" tab on the left panel of the screen.</li>
    </ul>
        <br><img alt="coordinates" src="/img/coordinates.png"/>
    <ul>    
        <li>There will be a list of all coordinates that you have sent and received. By clicking on an entry, you can
        view all locations that were sent or received in the past. Any pending requests that have not yet been
        responded to are not clickable.  Pending Coordinate requests have a closed envelope icon, while read Coordinates
        have an open envelope icon.</li>
    </ul>
    <br><font size="4"><b>Responding to Requests</b></font>
    <ul>
        <li>First, click on the "Coordinates" tab on the left panel of the screen.</li>
    </ul>
        <br><img alt="coordinates" src="/img/coordinates.png"/>
    <ul>
        <li>For any pending requests, there will be an entry that looks like the below:</li>
        <li>When a request is pending, neither party will be able to click the entry.</li>
        <li>If you would like to share your location, then click "Accept". The entry will be clickable and both
        parties will be able to see the coordinates.</li>
        <li>If you would not like to share your location, then click "Ignore". The entry will disappear from both
        parties' "Coordinates" pages.</li>
    </ul>
</div>
