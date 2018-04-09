<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $GLOBALS["check"] = 0;
        // validate submission
        if(empty($_POST["symbol"]))
        {
            apologize("Need the quote symbols.");
        }

        if(iconv_strlen( $_POST["symbol"]) > 3)
        {
            apologize("Unvalid symbol.");
        }

        if(is_numeric($_POST["symbol"]))
        {
            apologize("Unvalid symbol.");
        }



        $_POST=lookup($_POST["symbol"]);

        if($_POST == false)
        {
            apologize("No such stock available");
        }

        show_quote("quote_value","You number is: ");



    }



?>
