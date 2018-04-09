<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_form.php", ["title" => "Sell"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $rows = CS50::query("SELECT shares FROM shares WHERE symbol = '{$_POST["sell_quote"]}' AND user_id = {$_SESSION["id"]}");

        // validate submission
        if(empty($_POST["shares"]))
        {
            apologize("Need the quote symbols.");
        }
        else if(empty($_POST["sell_quote"]))
        {
            apologize("Need the quote symbols.");
        }
        else if($_POST["shares"] < 0)
        {
            apologize("Unvalid symbol.");
        }
         else if(!is_numeric($_POST["shares"]))
        {
            apologize("It's cat't be a letter!");
        }
         else if(!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Say no to float numbers!");
        }
        else if($_POST["shares"] > $rows[0]["shares"])
        {
            apologize("Don't have enough shares!");
        }
        else{

        $coast = lookup($_POST["sell_quote"]);
        $coast = number_format($coast["price"], 3);

        $shares = $_POST["shares"];

        $today = date("Y-m-d H:i:s");

        CS50::query("UPDATE `shares` SET shares= shares -{$shares} WHERE user_id = {$_SESSION["id"]} AND symbol='{$_POST["sell_quote"]}'");

        CS50::query("UPDATE `users` SET `cash`= `cash` + ({$shares} * {$coast}) WHERE `id` = {$_SESSION["id"]}");


        CS50::query("INSERT INTO `history`(`symbol`, `user_id`, `shares`, `price`, `date`) VALUES ('{$_POST["sell_quote"]}', {$_SESSION["id"]}, -{$shares}, {$coast}, '{$today}')");




        }

        $rows = CS50::query("SELECT shares FROM shares WHERE symbol = '{$_POST["sell_quote"]}' AND user_id = {$_SESSION["id"]}");

        if($rows[0]["shares"] == 0)
        {
            CS50::query("DELETE FROM `shares` WHERE user_id = {$_SESSION["id"]} AND symbol='{$_POST["sell_quote"]}'");
        }


    show_quote("sell_value","You number is: ");

    }



?>
