<?php
    session_start();
    include "../db.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $_SESSION['id'] = trim($_POST['opera']);
        var_dump($_SESSION['id']);

        $stmt = $conn->prepare("DELETE FROM Opera WHERE id_opera = ?");
        $stmt->bind_param("i", $_SESSION['id']);
        
        if($stmt->execute()){
            //Controllo Presenza Artisti
            $_SESSION['message'] = "Eliminazione Opera Riuscito";
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['message'] = "FALLITO";
            header("Location: index.php");
            exit;
        }

    } else{
        $_SESSION['message'] = "FALLITO";
        header("Location: index.php");
        exit;
    }
?>