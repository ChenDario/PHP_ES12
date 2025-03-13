<?php
    session_start();
    include "../db.php";

    $stmt = $conn->prepare("SELECT A.id_artista AS id, A.nome_artista AS Nome, A.cognome_artista AS Cognome FROM Artista A");
    $stmt->execute();
    $result = $stmt->get_result();

    if (isset($_SESSION['error_message'])) {
        echo "<script>alert('".$_SESSION['error_message']."');</script>";
        unset($_SESSION['error_message']); // Pulisce il messaggio dopo che è stato visualizzato
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PHP_ES12 Es1 </title>
</head>
<body>
    <div>
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