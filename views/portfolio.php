<div>
    <p style="font-size: 1.3em; opacity: 0.8;">Hello <?= $cash[0]["username"] ?>. This is you'r availbale balance: $<?="<b>" . $cash[0]["cash"] . "</b>"?><a href="money_up.php" id="money_up">    <img src="https://cdn0.iconfinder.com/data/icons/round-ui-icons/512/add_blue.png" alt=""></a></p>
    <table class="table table-striped">
        <tr style="font-weight: 900;">
            <td>SYMBOL</td>
            <td>SHARES</td>
            <td>PRISE</td>
            <td>TOTAL</td>
        </tr>
<?php
    $total = 0;
    foreach($positions as $position)
    {

        print("<tr>");
            print("<td>" . $position["symbol"] . "</td>");
            print("<td>" . $position["shares"] . "</td>");
            print("<td>$" . $position["price"] . "</td>");
            print("<td>$" . $position["price"] * $position["shares"] . "</td>");
        print("</tr>");
        $total += ($position["price"] * $position["shares"]);
    }
?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight: bold;">$<?= $total ?></td>
        </tr>
    </table>
</div>
