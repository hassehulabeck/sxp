<?php

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
$playerChoice = null;  // värdetyp? 0,1,2
$cpuChoice = null;

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


// Pseudokod
// Kolla om användaren har tryckt på något
if (isset($_POST['rock'])) {
    $playerChoice = 'rock';
}
if (isset($_POST['scissors'])) {
    $playerChoice = 'scissors';
}
if (isset($_POST['paper'])) {
    $playerChoice = 'paper';
}
// Låt datorn slumpa
$cpuChoice = ['rock', 'paper', 'scissors'][mt_rand(0, 2)];

// Kontrollera "vapen" - villkor
echo "<p>" . $playerChoice . " - " . $cpuChoice;
echo "<p>" . $regler[$playerChoice][$cpuChoice];

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
    </form>
</body>

</html>