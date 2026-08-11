<?php
$n1 = $_GET["num1"];
$n2 = $_GET["num2"];
$op = $_GET["operador"];
$result = 0;

switch ($op)
{
    case "+":
        $result = $n1 + $n2;
        break;
    case "-":
        $result = $n1 - $n2;
        break;
    case"*":
        $result = $n1 * $n2;
        break;
    case"/":
        $result = $n1 / $n2;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <?php echo "<h1>Resultado: $result</h1>"; ?>
    
</body>
</html>