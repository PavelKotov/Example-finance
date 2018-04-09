<?Php
    // configuration
    require("../includes/config.php");
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $name_check = CS50::query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

        $GLOBALS["check"] = 1;

        if(count($name_check) == 1)
        {
            apologize("This name is already taken");
        }


         // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must provide your password confirmation.");
        }
        else if ($_POST["confirmation"] !== $_POST["password"])
        {
            apologize("You write different passwords.\nTry again!");
        }


         // query database for user
        $rows = CS50::query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 5000.0000) ", $_POST["username"], crypt($_POST["password"]));
        $row_id = CS50::query("SELECT LAST_INSERT_ID() AS id");
        // // if we found user, check password
        $row = $row_id[0];
         if ($rows !== false)
         {

             if($row)
             {
                $_SESSION["id"] = $row["id"];
                redirect("/");
             }


             // first (and only) row
        //     $row = $rows[0];

        //     // compare hash of user's input against hash that's in database
        //     if (password_verify($_POST["password"], $row["hash"]))
        //     {
        //         // remember that user's now logged in by storing user's ID in session
        //         $_SESSION["id"] = $row["id"];

        //         // redirect to portfolio
        //         redirect("/");
            // }
        }
        else
        {
            apologize("Something wrong! :(");
        }
    }
?>