<?php
    session_start();
    include "../db.php";

    $stmt = $conn->prepare("SELECT A.id_artista AS id, A.nome_artista AS Nome, A.cognome_artista AS Cognome FROM Artista A");
    $stmt->execute();
    $result = $stmt->get_result();

    if (isset($_SESSION['message'])) {
        echo "<script>alert('".$_SESSION['message']."');</script>";
        unset($_SESSION['message']); // Pulisce il messaggio dopo che è stato visualizzato
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
        <h2> Elimina Opera </h2>
        <form action="delete.php" method="POST">
            <label for="nome">ID Opera</label>
            <select name="opera" id="opera" required>
                <?php
                    $stmt = $conn->prepare("SELECT O.nome_opera AS Nome, O.id_opera AS id FROM Opera O");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                        echo "
                            <option value='{$row['id']}'> {$row['id']} </option>
                        ";
                    }
                ?>
            </select>
            <input type="submit" value="Elimina opera">
        </form>
    </div>
</body>
</html>