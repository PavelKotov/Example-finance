<?php

    $cash = CS50::query("SELECT username, cash FROM users WHERE id = {$_SESSION["id"]}");
    // This displays the current information about the specified stock
    print("<p style='font-size: 1.5em;'>You sold <b>". $_POST["sell_quote"] . "</b> with <b>" . $_POST["shares"] . "</b> in amount of: $". ($GLOBALS["coast"] * $GLOBALS["shares"]) ."</p>");
    print("<br>");
?>
    <?="<p style='font-size: 1.5em;'>Your available balance:"?>  <?= "<b>$".$cash[0]["cash"]."</b>" ?>  <?= "</p>" ?>