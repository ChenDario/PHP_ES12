<?php
    session_start();
    include "../db.php";

    $stmt = $conn->prepare("SELECT A.id_artista AS id, A.nome_artista AS Nome, A.cognome_artista AS Cognome FROM Artista A");
    $stmt->execute();
    $result = $stmt->get_result();

    if (isset($_SESSION['error_message'])) {
        echo "<div class='alert'>".$_SESSION['error_message']."</div>";
        unset($_SESSION['error_message']);
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
    <title> PHP_ES12 Es1 </title>
</head>
<body>
    <div class="container">
        <h2> Opere Artista</h2>
        <form action="opere.php" method="POST">
            <label for="nome">Nome Artista</label>
            <select name="nomeArtista" id="nomeArtista" required>
                <?php
                    $stmt = $conn->prepare("SELECT A.id_artista AS id, A.nome_artista AS Nome, A.cognome_artista AS Cognome FROM Artista A");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                        echo "
                            <option value='{$row['id']}'> {$row['Nome']}, {$row['Cognome']} </option>
                        ";
                    }
                ?>
            </select>
            <input type="submit" value="Cerca opere">
        </form>
    </div>
</body>
</html>