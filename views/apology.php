<h1>Sorry!</h1>
<p><?= htmlspecialchars($message) ?></p>
<?php if ($GLOBALS["check"] == 1): ?>
    <p><a href="register.php">back</a></p>
<?php elseif($GLOBALS["check"] == 2): ?>
    <p><a href="login.php">back</a></p>
<?php else: ?>
    <p><a href="index.php">back</a></p>
<?php endif ?>


