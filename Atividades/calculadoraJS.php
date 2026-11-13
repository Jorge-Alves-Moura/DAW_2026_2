<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $num1 = $_GET["num1"];
            $num2 = $_GET["num2"];
            $operador = $_GET["operador"];
            $resultado = 0;

            switch($operador)
            {
                case '+':
                    $resultado = $num1 + $num2;
                    break;
                case '-':
                    $resultado = $num1 - $num2;
                    break;
                case '*':
                    $resultado = $num1 * $num2;
                    break;
                case '/':
                    if($num2 == 0) {
                        $resultado = "Divisao por zero!";
                        break;
                    }
                    $resultado = $num1 / $num2;
                    break;
                default:
                    $resultado = "Operador invalido!";
            }
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
    <h3>Resultado: <?php echo($resultado) ?> </h3>
</body>
</html>
