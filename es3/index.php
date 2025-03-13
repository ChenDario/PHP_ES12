<?php
    include "../db.php";

    $stmt = $conn->prepare("    WITH NumeroPitture AS (
                                    SELECT A.id_artista AS id, COUNT(O.id_opera) AS NumeroPitture
                                    FROM Artista A
                                    INNER JOIN Opera O ON O.id_artista = A.id_artista
                                    WHERE O.tipo_opera = 'Pittura' 
                                        AND (YEAR(O.data_opera) BETWEEN 1970 AND 1980)
                                    GROUP BY A.id_artista 
                                ), 
                                NumeroSculture AS (
                                    SELECT A.id_artista AS id, COUNT(O.id_opera) AS NumeroSculture
                                    FROM Artista A
                                    INNER JOIN Opera O ON O.id_artista = A.id_artista
                                    WHERE O.tipo_opera = 'Scultura' 
                                        AND (YEAR(O.data_opera) BETWEEN 1970 AND 1980)
                                    GROUP BY A.id_artista 
                                )
                                SELECT A.id_artista AS id, A.nome_artista AS Nome, A.cognome_artista AS Cognome, COALESCE(NP.NumeroPitture, 0) AS NumeroPitture, COALESCE(NS.NumeroSculture, 0) AS NumeroSculture
                                FROM Artista A
                                LEFT JOIN NumeroPitture NP ON NP.id = A.id_artista
                                LEFT OUTER JOIN NumeroSculture NS ON NS.id = A.id_artista");
    $stmt->execute();
    $result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Link CSS-->
     <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PHP_ES12 Es3 </title>
</head>
<body>
    <div>
        <h2> Numero di Pitture e Sculture realizzate nel 1970-80</h2>
        <table>
            <tr>
                <th> Artista </th>
                <th> Numero Pitture </th>
                <th> Numero Sculture </th>
            </tr>
            <?php
                while($row = $result->fetch_assoc()){
                    echo "
                        <tr onclick=\"window.location.href='opere.php?id={$row['id']}'\">
                            <td>{$row['Nome']} {$row['Cognome']}</td>
                            <td>{$row['NumeroPitture']}</td>
                            <td>{$row['NumeroSculture']}</td>
                        </tr>
                    ";
                }
            ?>
        </table>
    </div>
</body>
</html>