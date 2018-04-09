<div>

    <table class="table table-striped">
        <tr style="font-weight: 900;">
            <td>SYMBOL</td>
            <td>SHARES</td>
            <td>PRISE</td>
            <td>DATE</td>
        </tr>
<?php

    foreach($positions as $position)
    {

        print("<tr>");
            print("<td>" . $position["symbol"] . "</td>");
            print("<td>" . $position["shares"] . "</td>");
            print("<td>$" . $position["price"] . "</td>");
            print("<td>" . $position["date"] . "</td>");
        print("</tr>");
    }
?>
    </table>
</div>
