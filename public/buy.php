<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("buy_form.php", ["title" => "Buy"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        // $rows = CS50::query("SELECT shares FROM shares WHERE symbol = '{$_POST["sell_quote"]}' AND user_id = {$_SESSION["id"]}");

        // validate submission
        if(empty($_POST["shares"]))
        {
            apologize("Need the quote symbols.");
        }
        else if(empty($_POST["symbol"]))
        {
            apologize("Need the quote symbols.");
        }
        else if(is_numeric($_POST["symbol"]))
        {
            apologize("You shuld give the letters!");
        }
         else if(!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Say no to float numbers!");
        }
        else if(!is_numeric($_POST["shares"]))
        {
            apologize("It's cat't be a letter!");
        }
        else if($_POST["shares"] < 0)
        {
            apologize("Unvalid symbol.");
        }
        else{

        $_POST["symbol"] = strtoupper($_POST["symbol"]);

        $coast = lookup($_POST["symbol"]);
        if(!$coast){
            apologize("lookup function failed");
        }
        $coast = number_format($coast["price"], 3);

        $shares = $_POST["shares"];

        $cash = CS50::query("SELECT cash FROM users WHERE id = {$_SESSION["id"]}");
        if($cash[0]["cash"] < ($coast * $shares))
        {
            apologize("You don't have enough mouney DUDE...!");
        }

        CS50::query("INSERT `shares` (id, user_id, symbol, shares) VALUES (id, {$_SESSION["id"]}, '{$_POST["symbol"]}', {$_POST["shares"]})
        ON DUPLICATE KEY UPDATE shares = shares + {$_POST["shares"]}");

        CS50::query("UPDATE `users` SET `cash`= `cash` - ({$shares} * {$coast}) WHERE `id` = {$_SESSION["id"]}");

        $today = date("Y-m-d H:i:s");

        CS50::query("INSERT INTO `history`(`symbol`, `user_id`, `shares`, `price`, `date`) VALUES ('{$_POST["symbol"]}', {$_SESSION["id"]}, {$_POST["shares"]}, {$coast}, '{$today}')");




        }






        // $rows = CS50::query("SELECT shares FROM shares WHERE symbol = '{$_POST["symbol"]}' AND user_id = {$_SESSION["id"]}");

        // if($rows[0]["symbol"] == $_POST["symbol"] && $rows[0]["user_id"] == $_SESSION["id"])
        // {
        //     CS50::query("DELETE FROM `shares` WHERE user_id = {$_SESSION["id"]} AND symbol='{$_POST["symbol"]}'");
        // }


    show_quote("buy_value","You number is: ");

    }



?>
