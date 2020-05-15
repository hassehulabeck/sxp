<?php

session_start();

/* Skapa en applikation som:
    Sten-sax-påse.
    Sten > Sax
    Sax > Påse
    Påse > Sten

    Användaren väljer "vapen" i ett formulär.
    Datorn slumpar ett vapen.
    Vi jämför vapen och räknar poäng/utser en segrare.

    Fundera på:
    Pseudokod (i vilken ordning?)
    Värden och värdetyper?
    
*/

// Slå på all felrapportering. Bra under utveckling, dåligt i produktion.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initiera variabler

// Värden
$message = "";
$player = [
    'choice' => null,
    'score' => 0
];
$cpu = [
    'choice' => null,
    'score' => 0
];

// 3 x 3 de olika utfallen i en array. 
// $regler['rock']['paper'] Spelaren valt rock, cpu valt paper.
$regler = [
    'rock' => [
        'rock' => 'LIKA',
        'scissors' => 'VINNER',
        'paper' => 'FÖRLORAR'
    ],
    'scissors' => [
        'rock' => 'FÖRLORAR',
        'scissors' => 'LIKA',
        'paper' => 'VINNER'
    ],
    'paper' => [
        'rock' => 'VINNER',
        'scissors' => 'FÖRLORAR',
        'paper' => 'LIKA'
    ]
];

if (isset($_POST['reset'])) {
    session_destroy();
}

// Skriv över värden från sessionsvariabeln.
$player = $_SESSION['player'];
$cpu = $_SESSION['cpu'];



// Pseudokod
// Kolla om användaren har tryckt på något
if (isset($_POST['rock'])) {
    $player['choice'] = 'rock';
}
if (isset($_POST['scissors'])) {
    $player['choice'] = 'scissors';
}
if (isset($_POST['paper'])) {
    $player['choice'] = 'paper';
}




// Låt datorn slumpa
$cpu['choice'] = ['rock', 'paper', 'scissors'][mt_rand(0, 2)];

// Kontrollera "vapen" - villkor
echo "<p>" . $player['choice'] . " - " . $cpu['choice'];
echo "<p>" . $regler[$player['choice']][$cpu['choice']];

// Bokför poäng.
if ($regler[$player['choice']][$cpu['choice']] == 'VINNER') {
    $player['score']++;
}
if ($regler[$player['choice']][$cpu['choice']] == 'FÖRLORAR') {
    $cpu['score']++;
}
echo "<p>" . $player['score'] . " - " . $cpu['score'];

// Spara poängen.
$_SESSION['player'] = $player;
$_SESSION['cpu'] = $cpu;

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sten, sax, påse</title>
</head>

<body>
    <form action="index.php" method="post">
        <input type="submit" value="Sten" name="rock">
        <input type="submit" value="Sax" name="scissors">
        <input type="submit" value="Påse" name="paper">
        <p></p>
        <input type="submit" value="Ny match" name="reset">
    </form>
</body>

</html>