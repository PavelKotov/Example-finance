<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("money_up_form.php", ["title" => "Money"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        // validate submission
        if(empty($_POST["money"]))
        {
            apologize("enter amount of money please.");
        }
        else if(!is_numeric($_POST["money"]))
        {
            apologize("Unvalid enter.");
        }
        else
        {
        CS50::query("UPDATE `users` SET `cash`= `cash` + {$_POST["money"]} WHERE id = {$_SESSION["id"]}");
        redirect("index.php");
        }

    }



?>
