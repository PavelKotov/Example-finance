<?php

    // configuration
    require("../includes/config.php");






    $rows = CS50::query("SELECT * FROM shares WHERE user_id = {$_SESSION["id"]}");
    // This is the balance of the user
	$cash = CS50::query("SELECT username, cash FROM users WHERE id = {$_SESSION["id"]}");

    $positions = [];

    foreach($rows as $row)
    {

    $stock = lookup($row['symbol']);


    if($stock != false)
    {

        $positions[]=[

            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $row["shares"],
            "symbol" => $row["symbol"],



            ];
    }
    else
    {
        $positions[]=[

            "name" => $stock["name"],
            "price" => "Couldn't get information, server don't reply :(",
            "shares" => $row["shares"],
            "symbol" => $row["symbol"],



            ];
    }
    }

    // var_dump($cash);
    // var_dump($stock);
    // var_dump($positions);




//     // render portfolio
    render("portfolio.php", ["title" => "Positions", "positions" => $positions, "cash" => $cash]);




?>