<?php
   /**************************************************************************
    * historyapi.php                                                         *
    *                                                                        *
    * Creates a json-encoded api of all entries in the SQL request database  *
    * as well as several other attributes associated with each               *
    *                                                                        *
    * Max Lu                                                                 *
    **************************************************************************/
    // configuration
    require("../includes/config.php");
    
    //queries database for all requests where the current user is either a sender or receiver
    $history = query("SELECT * FROM requests WHERE senderid=? OR receiverid=?", $_SESSION["id"],$_SESSION["id"]);
    
    // iterates over each request to add corresponding receiver name, sender name, and the user's session id
    foreach ($history as &$row)
    {
        $receiverinfo = query("SELECT name FROM users WHERE id=?", $row["receiverid"]);
        $senderinfo = query("SELECT name FROM users WHERE id=?", $row["senderid"]);
        $row["receivername"]=$receiverinfo[0]["name"];
        $row["sendername"]=$senderinfo[0]["name"];
        $row["sessionid"] = $_SESSION["id"];
    }
    // prints out the json encoded array
    echo json_encode($history);
?>

