<?php
   /**************************************************************************
    * help.php                                                               *
    *                                                                        *
    * Renders the showhelp.php template                                      *
    *                                                                        *
    * Max Lu                                                                 *
    **************************************************************************/
    // configuration
    require("../includes/config.php");
    // finds name of current user from SQL table
    $name = query("SELECT name FROM users WHERE id =?", $_SESSION["id"]);
    // renders showhelp.php page
    render("showhelp.php", ["title" => "Help","name" => $name[0]["name"]]);
?>
