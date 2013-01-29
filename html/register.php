<?php
   /**************************************************************************
    * register.php                                                           *
    *                                                                        *
    * Registers a user by handling form register_form.php form submission    *
    * and inserting the user into the SQL database.                          *
    * Code modified from Problem Set 7 distribution code.                    *
    *                                                                        *
    * Max Lu                                                                 *
    **************************************************************************/
    
    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate inputs
        if (empty($_POST["name"]))
        {
            apologize("You must provide a name.");
        }
        else if (empty($_POST["email"]))
        {
            apologize("You must provide an email address.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must choose a password.");
        }
        else if (empty($_POST["confirmation"]) || $_POST["password"] != $_POST["confirmation"])
        {
            apologize("Those passwords did not match.");
        }

        // try to register user
        $results = query("INSERT INTO users (name, email, hash) VALUES(?, ?, ?)", 
            $_POST["name"], $_POST["email"], crypt($_POST["password"]));
        if ($results === false)
        {
            apologize("You have already registered with this email.");
        }

        // get new user's ID
        $results = query("SELECT LAST_INSERT_ID() AS id");
        $id = $results[0]["id"];

        // log user in
        $_SESSION["id"] = $id;

        // redirect to portfolio
        redirect("/");
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
