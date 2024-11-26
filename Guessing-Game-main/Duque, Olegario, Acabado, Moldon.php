<!-- Acabado, Melky
 Olegario, Angelica
 Moldon, Michaela
 Duque, Christian Jay -->


<?php
session_start();
$angsagot = 5; // ito yung sagot
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}
$message = "";

$totalAttempts = 3; // kung ilan pwede gawin

if (isset($_POST['guess'])) {
    $guess = intval($_POST['guess']);
    $_SESSION['attempts']++;

    if ($guess < $angsagot) {
        $message = "taas onti.";
    } elseif ($guess > $angsagot) {
        $message = "masyadong malaki.";
    } else {
        $message = "magaling kaibigan!";
        session_destroy();
    }

    $attemptsLeft = $totalAttempts - $_SESSION['attempts'];

    if ($_SESSION['attempts'] >= $totalAttempts && $guess !== $angsagot) {
        $message .= " The secret number was " . $angsagot . ".";
        session_destroy();
    } elseif ($guess !== $angsagot) {
        $message .= " You have " . $attemptsLeft . " attempts left.";
    }
} elseif (isset($_POST['reset'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
} else {
    $message = "Guess the number (between 1 and 10):";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess the Number Game</title>
</head>
<body>
    <h1>Guess the Number Game</h1>
    <p><?php echo $message; ?></p>
    <?php if (!isset($_SESSION['attempts']) || $_SESSION['attempts'] < $totalAttempts): ?>
        <form method="post" action="">
            <input type="number" name="guess" min="1" max="10" required>
            <input type="submit" value="Submit Guess">
        </form>
    <?php endif; ?>
    <?php if (isset($_SESSION['attempts']) && $_SESSION['attempts'] >= $totalAttempts): ?>
        <form method="post" action="">
            <input type="submit" name="reset" value="Start New Game">
        </form>
    <?php endif; ?>
</body>
</html>


