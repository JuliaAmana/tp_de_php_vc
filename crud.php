<?php
// Connexion à la base de données
session_start();
extract($_POST);
extract($_GET);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UDBL";
$id = $_SESSION['id'];
//var_dump($nom);

$conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

$sql = "SELECT * FROM Etudiant";
$query = $conn->query($sql);
$result = $query->fetchAll();

if (count($result) > 0) {
    if (isset($nom) &&
        isset($postnom) &&
        isset($prenom) &&
        isset($matricule) &&
        isset($genre) &&
        isset($promotion)) {

        if (isset($ajouter)) {
            foreach ($result as $etudiant) {
                if ($matricule === $etudiant['matricule']) {
                    echo "Cet utilisateur existe déjà";
                    break;
                } else {
                    try {
                        $sql = "INSERT INTO 
                                Etudiant (nom, postnom, prenom, matricule, genre, promotion) 
                                VALUES ('$nom', '$postnom', '$prenom', '$matricule', '$genre', '$promotion')";
                        $query = $conn->query($sql);
                        header('Location: index.php');

                    } catch (Exception $exception) {
                        $exception = "Un problème est survenue lors de l'ajout de l'étudiant, veuillez modifier le matricule avant de réessayer";
                        die('Erreur : ' . $exception);
                    }
                }
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($modifier)) {
            try {
                foreach ($result as $etudiant) {
                    $sql = "UPDATE Etudiant SET nom='$nom', 
                    postnom='$postnom', prenom='$prenom', 
                    matricule='$matricule', genre='$genre', 
                    promotion='$promotion' WHERE id=$id";
                    $query = $conn->query($sql);
                    if ($query)
                        header('Location: index.php');
                    else
                        continue;
                }

            } catch (Exception $exception) {
                $exception = "Un problème est survenue lors de la modification de l'étudiant, vous pouvez réessayer plus tard";
                die('Erreur : ' . $exception);
            }
        }
    }else {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($id_suppr)) {
            try {
                foreach ($result as $etudiant) {
                    $sql = "DELETE FROM Etudiant WHERE id=$id_suppr";
                    $query = $conn->query($sql);
                    if ($query)
                        header('Location: index.php');
                    else
                        continue;
                }
            } catch (Exception $exception) {
                $exception = "Un problème est survenue lors de la suppréssion de l'étudiant, vous pouvez réessayer plus tard";
                die('Erreur : ' . $exception);
            }

        } else {
            header("Location: index.php");
            echo "0 résultats";
        }
    }
}
else{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($ajouter)) {

        try {
            $sql = "INSERT INTO 
                                Etudiant (nom, postnom, prenom, matricule, genre, promotion) 
                                VALUES ('$nom', '$postnom', '$prenom', '$matricule', '$genre', '$promotion')";
            $query = $conn->query($sql);
            header('Location: index.php');

        } catch (Exception $exception) {
            $exception = "Un problème est survenue lors de l'ajout de l'étudiant, veuillez modifier le matricule avant de réessayer";
            die('Erreur : ' . $exception);
        }

    }
}

?>