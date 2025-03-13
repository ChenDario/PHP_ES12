<?php
    session_start();
    include "../db.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $_SESSION['artista'] = trim($_POST['nomeArtista']);
    } else{
        //Controllo Presenza Artisti
        $_SESSION['error_message'] = "Nome o Cognome erratto.";
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Link CSS-->
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Opere Artista</title>
</head>
<body>
    <div class="container">
        <table>
            <tr>
                <th> Nome Opera</th>
                <th> Tipo Opera</th>
            </tr>            
            <?php
                $stmt = $conn->prepare("SELECT O.nome_opera AS nome, O.tipo_opera AS tipo FROM Opera O WHERE O.id_artista = ?");
                $stmt->bind_param("i", $_SESSION['artista']);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    echo "
                        <tr>
                            <th>{$row['nome']}</th>
                            <th>{$row['tipo']}</th>
                        </tr>
                    ";
                }
            ?>
        </table>
    </div>
</body>
</html>