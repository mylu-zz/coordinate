<?php
   /**************************************************************************
    * logout.php                                                             *
    *                                                                        *
    * Logs the user out.                                                     *
    * Code taken directly from Problem Set 7 distribution code               *
    *                                                                        *
    * Max Lu                                                                 *
    **************************************************************************/

    // configuration
    require("../includes/config.php"); 

    // log out current user, if any
    logout();

    // redirect user
    redirect("/");

?>
