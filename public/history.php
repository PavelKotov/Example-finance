<?php

    // configuration
    require("../includes/config.php");






    $rows = CS50::query("SELECT * FROM history WHERE user_id = {$_SESSION["id"]}");
    // This is the balance of the user

    $positions = [];

    foreach($rows as $row)
    {


        $positions[]=[

            "symbol" => $row["symbol"],
            "shares" => $row["shares"],
            "price" => $row["price"],
            "date" => $row["date"],



            ];

    }

    // var_dump($cash);
    // var_dump($stock);
    // var_dump($positions);




//     // render portfolio
    render("history_output.php", ["title" => "Positions", "positions" => $positions]);




?>