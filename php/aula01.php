<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $nome = "Jackson Five";
    $idade = 38;

    echo "Olá Mundo! $nome Idade: $idade";
    echo "<br>";
    if ($idade >= 18) {
        echo " De maior";
    } else {
        echo " de Menor";
    }

    echo "<br>";
    $nomes = ['Jackson Five', "Ana", "Chavez", "Maria", "José"];

    for ($i = 0; $i < count($nomes); $i++) {
        echo $nomes[$i] . "<br>";
    }

    echo "<br>";

    foreach ($nomes as $item) {
        echo $item . "<br>";
    }


    ?>
</body>

</html>