/*****************************************************************************
 * main.js                                                                   *
 *                                                                           *  
 * Provides main functions and helper functions for website that dynamically *
 * changes the html of the page given user input:                            *
 *     Loads map and calls APIs when page is loaded                          *
 *     Calls functions that respond to user clicking Coordinates, Share,     *
 *         Request, and Contacts button                                      *   
 *     Calls functions that respond to other events that become visible      *
 *         once those buttons are called                                     *
 *                                                                           *
 * Max Lu                                                                    *
 *****************************************************************************/

// global variables
var contacts = [];
var map;
var lat;
var long;

/**
 * Clears contactinfo div defined in map.php
 */
function clearContactInfo() {
    $('#contactinfo').html("");
}

/**
 * Loads inbox by changing option div's html by calling the addCoordinateToList
 * method for each Coordinate entry
 */
function showInbox() {
    // clears option div's html
    $('#option').html("");
    // iterates over each Coordinate entry in history
    for (var i = history.length - 1; i >= 0; i--)    
        addCoordinateToList(i);
}

/**
 * Creates a ul object for each event and sets its html using formatCoordinate
 * Defines functions that are executed whenever user hovers over or clicks object
 */    
function addCoordinateToList(i) {
    var entry = $('<ul/>'); 
    // creates formatted html to display each request                      
    entry.html(formatCoordinate(i)); 
    // adds the html to the option div     
    entry.appendTo('#option'); 
    
    // defines functions that handle user hovering over entry
    entry.hover(
    // if mouse hovers over Coordinate entry and it is read, highlight it                                 
    function () {
        if (history[i].openreceiver === 0)                     
            entry.addClass('highlighted');                   
    }, 
    // if mouse doesn't hover over Coordinate entry, do not highlight it
    function () {
        if (history[i].openreceiver === 0)    
            entry.removeClass('highlighted');
    });  
     
    //if user clicks entry and it is read, plot the request's latitude and longitude onto map             
    entry.click(function () {
        if (history[i].openreceiver === 0)                   
            plotCoordinate(i);
    });   
}

/**
 * Formats a Coordinate entry from the history API into HTML and returns it
 */
function formatCoordinate(i)
{
    // build HTML string
    var html = "";
    
    // if the current user was the receiver of a Coordinate
    if (history[i].receiverid=== history[i].sessionid) {
        // if the Coordinate is unread and of type "request" (someone else asked for user's position)
        if ((history[i].type==="Request" && history[i].openreceiver === 1))
            // include the unread image
            html += "<img src=\"img/close.gif\" alt=\"unread\">";
        // else include the read image
        else
            html += "<img src=\"img/open.gif\" alt=\"read\">";
        
        // builds html for Coordinate entry based on its sender name, type, date, and messge
        html += "&nbsp;&nbsp;<b>" + history[i].sendername + "</b><br><i>" + history[i].type + "&nbsp;received&nbsp;on<br>";
        html += history[i].date.substring(0,10) + "&nbsp;at&nbsp;" + history[i].date.substring(11);
        html += "</i><br><br>" + history[i].mess;
        // if the Coordinate is unread and of type "request" (someone else asked for user's position)
        if (history[i].type === "Request" && history[i].openreceiver === 1) {
            // include buttons that allow user to accept or ignore coordinate request, handled by index.php
            html += "<br><form action=\"index.php\" method=\"post\"><div class=\"control-group\">";
            // send over sender, date, and position data in hidden form
            html += "<input name=\"sender\" value = \"" + history[i].senderid + "\" type=\"hidden\"/>";
            html += "<input name=\"requestdate\" value = \"" + history[i].date + "\" type=\"hidden\"/>";
            html += "<input name=\"requestlat\" value=\"" + lat+ "\" type=\"hidden\"/>";
            html += "<input name=\"requestlong\" value=\"" + long+ "\" type=\"hidden\"/></div>";
            // create buttons
            html += "<div align =right class=\"control-group\"><button type=\"submit\" name = \"caccept\" class=\"btn btn-mini\">Accept</button>";
            html += "&nbsp;<button type=\"submit\" name = \"cignore\" class=\"btn btn-mini\">Ignore</button></div></fieldset></form>";
            html += "</div></fieldset></form>";
        }
    }
    // if user sent the coordinate
    else
    {
        // if the Coordinate is unread and of type "request" (someone else asked for user's position)
        if ((history[i].type==="Request" && history[i].openreceiver === 1))
            // include the unread image
            html += "<img src=\"img/close.gif\" alt=\"unread\">";
        // else include the read image
        else
            html += "<img src=\"img/open.gif\" alt=\"read\">";
        // builds html for Coordinate entry based on its sender name, type, date, and messge
        html += "&nbsp;&nbsp;<b>" + history[i].receivername + "</b><br><i>" + history[i].type + "&nbsp;sent&nbsp;on<br>";
        html += history[i].date.substring(0,10) + "&nbsp;at&nbsp;" + history[i].date.substring(11);
        html += "</i><br><br>" + history[i].mess;
    }
    // returns the updated HTML string
    return html;
}   

/**
 * Plots a Coordinate entry from the history API onto the map and centers it
 */
function plotCoordinate(i) {
    // creates a google LatLng object that keeps track of friend's position
    var friendLatLng = new google.maps.LatLng(history[i].latitude,history[i].longitude);
    // declares the paramters for the map
    var mapOptions = {
        zoom: 16,
        center: friendLatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // creates a new map and inserts it into the map_canvas div
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    // creates a marker on the map for friend's location
    var marker = new google.maps.Marker({
        position: friendLatLng,
        map: map,
        title: "Friend Location"
    });
}

/**
 * Loads contact list by changing option div's html by calling the addFriendToList
 * method for each contact in contacts global variable. Also creates a button that
 * loads a form to add a contact.
 */
function showContacts() {
    // resets option div's html
    $('#option').html("");
    // iterates over each contact in contacts
    for (var i = 0; i < contacts.length; i++)
        // populates option div with each contact
        addFriendToList(i);
    // creates button to add contact
    var entry = $('<ul/>');
    entry.html("<br><a href=\"#\" class=\"btn btn-danger\" id=\"addcontact\">Add Contact</a>");
    entry.appendTo('#option');
    // if button is clicked, then change contactinfo div
    entry.click(function() {
        showContactInfo(-1);
    });
}

/**
 * Creates a ul object for each friend and sets its html
 * Defines functions that are executed whenever user hovers over or clicks object
 */    
function addFriendToList(i) {
    var entry = $('<ul/>');
    // adds friend's name to the option div                       
    entry.html(contacts[i].friendname);       
    entry.appendTo('#option'); 
    // defines function that responds to user hovering over friend entry
    entry.hover(
    // if user is hovering over entry, highlight it                                 
    function () {                                
        entry.addClass('highlighted');
    },
    // if user is not hovering, unhighlight it 
    function () {
        entry.removeClass('highlighted');
    });        
    
    // if user clicks the contact, show its contact info        
    entry.click(function () {
        showContactInfo(i);
    });   
}

/**
 * Changes the contactinfo div's HTML to either display a user's contact info or a form to add a contact
 */ 
function showContactInfo(i) 
{
    //base html
    var contactInfoHTML = "<hr align=\"center\" width=\"100%\"><br><br>";
    // if the user clicked "add contact" button
    if (i==-1)
    {
        // create a form that will be handled by index.php
        var form = "<form action=\"index.php\" method=\"post\"><fieldset>";
        form += "<div class=\"control-group\">";
        // text field for user input (email)
        form += "<input autofocus name=\"addemail\" placeholder=\"Email Address\" type=\"text\"/></div>";
        // create submit button
        form += "<div class=\"control-group\"><button type=\"submit\" name = \"add\" class=\"btn\">Add</button>";
        form += "</div></fieldset></form>";
        // set contactinfo div's html
        $('#contactinfo').html(contactInfoHTML + form);
    }
    // else display the contact information
    else
    {
        // find the contact's name
        var name = contacts[i].friendname;
        // add the contact's name and email to html
        var info = "<div align=center>" + name + "<br>" + contacts[i].email;
        // create a form handled by index.php that will delete friends
        info += "<form action=\"index.php\" method=\"post\"><fieldset><div class=\"control-group\">";
        info += "<input autofocus name=\"deleteemail\" value=" + contacts[i].email + " type=\"hidden\"/></div>";
        info += "<div class=\"control-group\"><button type=\"submit\" name = \"delete\" class=\"btn\">Delete</button>";
        info += "</div></fieldset></form></div>";
        // set contactinfo div's html
        $('#contactinfo').html(contactInfoHTML + info);         
    }    
}

/**
 * Changes the option div's HTML to display a form to send a share coordinate
 */ 
function showShare() {
    // creates a form handled by index.php
    var html = "<form action=\"index.php\" method=\"post\"><fieldset>";
    html+="<div class=\"control-group\"><select name=\"sharefriend\"><option value=\"\"></option>";
    // creates dropdown menu for each contact
    for (var i=0; i < contacts.length; i++) 
        html+="<option value = \"" + contacts[i].email + "\">" + contacts[i].friendname + "</option>";
    
    html += "</select></div><br><div class=\"control-group\">";
    // creates field to send optional message
    html += "<textarea rows=\"3\" name=\"sharemessage\" placeholder=\"Enter optional message\" type=\"text\"></textarea>";
    // creates hidden fields to store user's position
    html += "<input name=\"latitude\" value=\"" + lat+ "\" type=\"hidden\"/>";
    html += "<input name=\"longitude\" value=\"" + long+ "\" type=\"hidden\"/></div>";
    // creates submit button
    html += "<div class=\"control-group\"><button type=\"submit\" name = \"share\" class=\"btn\">Share your Coordinate</button>";
    html += "</div></fieldset></form>";
    // sets option's div's HTML
    $('#option').html(html);
    clearContactInfo();
}

/**
 * Changes the option div's HTML to display a form to send a request coordinate
 */ 
function showRequest() {
    // build html string
    var html = "";
    // create form that is handled by index.php
    html = "<form action=\"index.php\" method=\"post\"><fieldset>";
    // creates dropdown menu for each contact
    html += "<div class=\"control-group\"><select name=\"requestfriend\"><option value=\"\"></option>";
    for (var i=0; i < contacts.length; i++) 
        html+="<option value = \"" + contacts[i].email + "\">" + contacts[i].friendname + "</option>";
    
    html += "</select></div><br><div class=\"control-group\">";
    // creates field to send optional message
    html += "<textarea rows=\"3\" name=\"requestmessage\" placeholder=\"Enter optional message\" type=\"text\"></textarea>";
    html += "</div><div class=\"control-group\">";
    // creates submit button
    html += "<button type=\"submit\" name = \"request\" class=\"btn\">Request a Coordinate</button>";
    html += "</div></fieldset></form>";
    // sets option's div's HTML
    $('#option').html(html);
    clearContactInfo();
}

/**
 * Initializes map using geolocation
 * Modified from Google's sample code
 * https://developers.google.com/maps/documentation/javascript/tutorial#HelloWorld
 * https://google-developers.appspot.com/maps/documentation/javascript/examples/map-geolocation
 */ 
function initializeMap() {
    // creates map options
    var mapOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // creates new map and displays it in map_canvas div
    map = new google.maps.Map(document.getElementById('map_canvas'),
        mapOptions);

    // try HTML5 geolocation
    if(navigator.geolocation) {
        // calls getCurrentPosition to get user's position
        navigator.geolocation.getCurrentPosition(
            // if successful
            function(position) {
                // create new LatLng from user's position
                var pos = new google.maps.LatLng(position.coords.latitude,
                                     position.coords.longitude);
                // stores user's position into global variables                     
                lat=position.coords.latitude;
                long=position.coords.longitude;
                
                // creates marker for user's current position
                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: "My Location",
                });
                // centers map at user's current position
                map.setCenter(pos);
            }, 
            //if unsuccessful
            function() {
                handleNoGeolocation(true);
            });
    }
    // Browser doesn't support Geolocation
    else {
        
        handleNoGeolocation(false);
    }
}

/**
 * Handles cases when geolocation fails
 * Modified from Google's sample code
 * https://google-developers.appspot.com/maps/documentation/javascript/examples/map-geolocation
 */
function handleNoGeolocation(error) {
    // if browser supports geolocation but it failed
    if (error) {
        var content = 'Error: The Geolocation service failed.';
    } 
    // if browser does not support geolocation
    else {
        var content = 'Error: Your browser doesn\'t support geolocation.';
    }
    // sets options for default map
    var options = {
        map: map,
        position: new google.maps.LatLng(42.374061,-71.116012),
        content: content
    };
    // creates infowindow that notifies user of failure
    var infowindow = new google.maps.InfoWindow(options);
    // centers map on default postion
    map.setCenter(options.position);
}            

/*
 * Executed when page loads
 */
$(document).ready(function () {
    // uses ajax to retrieve data from contactsapi.php api and stores it in contacts
    $.ajax({
        url: '/contactsapi.php',
        dataType: 'json',
        success: function (data) {
            contacts = data;
        }
    });
    
    // uses ajax to retrieve data from historyapi.php api and stores it in history
    $.ajax({
        url: '/historyapi.php',
        dataType: 'json',
        success: function (response) {
            history = response;
        }
    });
    
    // loads map
    google.maps.event.addDomListener(window, 'load', initializeMap);
    
    // sets contactinfo's html to blank
    $('#contactinfo').html("");
    
    // assigns functions that are executed when a button is clicked
    $('#contacts').click(showContacts);
    $('#share').click(showShare);
    $('#request').click(showRequest);
    $('#inbox').click(showInbox);
    
});
