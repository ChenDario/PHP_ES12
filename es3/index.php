<?php
    session_start();
    include "../db.php";

    $stmt = $conn->prepare("SELECT A.nome_artista AS Nome, A.cognome_artista AS Cognome FROM Artista A
                            INNER JOIN Opera O ON O.id_artista = A.id_artista
                            WHERE O.tipo_opera = 'Scultura' 
                                AND (YEAR(O.data_opera) BETWEEN 1970 AND 1980)");
    $stmt->execute();
    $result = $stmt->get_result();


    $stmt2 = $conn->prepare("SELECT A.nome_artista AS Nome, A.cognome_artista AS Cognome FROM Artista A
                            INNER JOIN Opera O ON O.id_artista = A.id_artista
                            WHERE O.tipo_opera = 'Scultura' 
                                AND (YEAR(O.data_opera) BETWEEN 1970 AND 1980)");
    $stmt2->execute();
    $result2 = $stmt2->get_result();

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
        <table>
            
        </table>
    </div>
</body>
</html>