<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select name="sell_quote" class="form-group"
            style="display: block;
            margin: 20px auto;
            height: 40px;
            width: 172px;
            opacity: 0.75;
            ">
                <?php

                    $rows = CS50::query("SELECT symbol FROM shares WHERE user_id = {$_SESSION["id"]}");
                    $row_symbol = $rows;
                    foreach($row_symbol as $row)
                    {
                        print("<option>" . $row["symbol"] . "</option>");
                    }

                    // var_dump($rows);

                ?>
            </select>
            <input autocomplete="off" autofocus class="form-control" name="shares" placeholder="shares" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true"></span>
                Sell
            </button>
        </div>
    </fieldset>
</form>



