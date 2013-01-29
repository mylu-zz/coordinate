<?php
   /**************************************************************************
    * index.php                                                              *
    *                                                                        *
    * Loads map and handles form submission from most buttons on home page.  *
    * Communicates with SQL database in order to add and delete contacts,    *
    * as well as create and handle Coordinate requests.                      *
    *                                                                        *
    * Max Lu                                                                 *
    **************************************************************************/  

    // configuration
    require("../includes/config.php");
    
    // finds current user's name from database
    $name = query("SELECT name FROM users WHERE id =?", $_SESSION["id"]); 
    
    // if the user clicked the add contacts button
    if (isset($_POST["add"])) {
        // if user did not include an email to add
        if(empty($_POST["addemail"])) {
            apologize("You must enter an email");
        }
        else {
            // queries database for friend
            $friend = query("SELECT id FROM users WHERE email=?",$_POST["addemail"]);
            if (sizeof($friend) == 0)
                apologize("The user is not using coordinate. Send an invite!");
            // if friend is in database, adds friendship into database
            else {
                query("INSERT INTO friends (id,friend) VALUES(?,?)",$_SESSION["id"],$friend[0]["id"]);
                redirect("/");
            }
        }    
    }
    
    // if the user clicked the delete contact button
    else if (isset($_POST["delete"])) {
        // find the user by finding id from user table for corresponding email
        $friendid = query("SELECT id FROM users WHERE email=?",$_POST["deleteemail"]);
        // deletes friendship from friends database
        query("DELETE FROM friends WHERE id = ? AND friend = ?", $_SESSION["id"],$friendid[0]["id"]);
        redirect("/");
    }
    
    // if the user clicked the share button
    else if (isset($_POST["share"])) {
        // if user did not select a friend
        if (empty($_POST["sharefriend"])) {
            apologize("You must select a friend!");
        }
        else {
            // find the id of friend to send the share
            $shareid = query("SELECT id FROM users WHERE email=?",$_POST["sharefriend"])[0]["id"];
            // insert the new request using senders latitude and longitude and setting it as "read"
            query("INSERT INTO requests (senderid,receiverid,type,latitude,longitude,mess,openreceiver) VALUES(?,?,?,?,?,?,?)", 
                $_SESSION["id"],$shareid,"Share",$_POST["latitude"],$_POST["longitude"],$_POST["sharemessage"],0);
            redirect("/");
        }
    }
    
    // if the user clicked the request button
    else if (isset($_POST["request"])) {
        // if user did not select a friend
        if (empty($_POST["requestfriend"])) {
            apologize("You must select a friend!");
        }
        else {
            // find the id of friend to send the share
            $requestid = query("SELECT id FROM users WHERE email=?",$_POST["requestfriend"])[0]["id"];
            // insert the new request using sender and receiver id's and setting it as "unread"
            query("INSERT INTO requests (senderid,receiverid,type,mess,openreceiver) VALUES(?,?,?,?,?)", 
                $_SESSION["id"],$requestid,"Request",$_POST["requestmessage"],1);
            redirect("/");
        }
    }   
    
    // if the user clicked the accept button for a request
    else if (isset($_POST["caccept"])) {
        // set the request as read
        query("UPDATE requests SET openreceiver=0 WHERE senderid=? AND date=?",$_POST["sender"],$_POST["requestdate"]);
        // set the latitude and longitude to user's current latitude and longitude
        query("UPDATE requests SET latitude=?, longitude=? WHERE senderid=? AND date=?",
            $_POST["requestlat"],$_POST["requestlong"],$_POST["sender"],$_POST["requestdate"]);
        redirect("/");
    }
    
    // if the user clicked the ignore button for a request
    else if (isset($_POST["cignore"])) {
        // delete the request from the table
        query("DELETE FROM requests WHERE senderid=? AND date=?", $_POST["sender"],$_POST["requestdate"]);
        redirect("/");
    }
    
    // if no buttons are clicked, render map    
    else
        render("map.php", ["title" => "Home","name" => $name[0]["name"]]);
    
?>
