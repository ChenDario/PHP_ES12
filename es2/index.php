<?php
    session_start();
    include "../db.php";

    $stmt = $conn->prepare("SELECT A.id_artista AS id, A.nome_artista AS Nome, A.cognome_artista AS Cognome FROM Artista A");
    $stmt->execute();
    $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Link CSS-->
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PHP_ES12 Es2 </title>
</head>
<body>
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert-message">
            <?php echo htmlspecialchars($_SESSION['message']); ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <div class="container">
        <h2> Elimina Opera </h2>
        <form class="dark-form" action="delete.php" method="POST">
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