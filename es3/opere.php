<?php
    include "../db.php";
    
    if(isset($_GET['id'])) {
        $id = intval($_GET['id']);

        // Recupera informazioni artista
        $stmt_artist = $conn->prepare("SELECT nome_artista, cognome_artista FROM Artista WHERE id_artista = ?");
        $stmt_artist->bind_param("i", $id);
        $stmt_artist->execute();
        $result_artist = $stmt_artist->get_result();
        
        if ($result_artist->num_rows === 0) {
            header("Location: index.php");
            exit();
        }
        $artist = $result_artist->fetch_assoc();
        // Recupera opere
        $stmt = $conn->prepare("SELECT A.nome_artista AS Nome, A.cognome_artista AS Cognome, O.nome_opera AS DataOpera, 
                                       O.data_opera AS NomeOpera, O.tipo_opera AS Tipo
                                FROM Artista A
                                INNER JOIN Opera O ON O.id_artista = A.id_artista
                                WHERE A.id_artista = ?
                                    AND YEAR(O.data_opera) BETWEEN 1970 AND 1980");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
    } else {
        // Handle missing ID
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Link CSS-->
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Works</title>
</head>
<body>
    <h1>Opere di <?php echo htmlspecialchars($artist['nome_artista']) . ' ' . htmlspecialchars($artist['cognome_artista']); ?></h1>
    <div>
        <table>
            <tr>
                <th>Nome Opera</th>
                <th>Data Opera</th>
                <th> Tipo </th>
            </tr>
            <?php
                while($row = $result->fetch_assoc()){
                    echo "
                        <tr>
                            <td>{$row['NomeOpera']}</td>
                            <td>{$row['DataOpera']}</td>
                            <td>{$row['Tipo']}</td>
                        </tr>
                    ";
                }
            ?>
        </table>
    </div>
</body>
</html>