<?php
   /**************************************************************************
    * contactsapi.php                                                        *
    *                                                                        *
    * Creates a json-encoded api of all entries in the SQL friends database  *
    * as well as several other attributes associated with each.              *
    *                                                                        *
    * Max Lu                                                                 *
    **************************************************************************/
    // configuration
    require("../includes/config.php");
    // queries database for all of current user's friends
    $contacts = query("SELECT friend FROM friends WHERE id=?", $_SESSION["id"]);
    // iterates over each friend and adds corresponding name and email
    foreach ($contacts as &$contact)
    {
        $friendinfo = query("SELECT name,email FROM users WHERE id=?", $contact["friend"]);
        $contact["friendname"]=$friendinfo[0]["name"];
        $contact["email"]=$friendinfo[0]["email"];
    }
    
    // prints out json encoded array
    echo json_encode($contacts);
?>



