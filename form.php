<?php
    session_start();
    extract($_GET);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "UDBL";
    $id = isset($id) ? $id : '';
    $_SESSION['id'] = isset($id) ? $id : '';

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

    $title = "Ajouter un nouvel étudiant";

    if (!empty($id)){
        $title = "Modifier l'étudiant";
        $sql2 = "SELECT * FROM Etudiant WHERE id=$id limit 1";
        $query2 = $conn->query($sql2);
        $etudiant2 = $query2->fetch();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <!-- MDB -->
    <link
            href="mdb.min.css"
            rel="stylesheet"
    />

    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css"
            rel="stylesheet"
    />
</head>
<body>

    <div class="container mt-5">
        <h2 class="fw-light"><?php echo $title ?></h2>
        <form action="crud.php" method="post" class="vstack gap-2 mb-4 mt-4">
            <div class="form-outline" data-mdb-input-init>
                <input type="text" id="formControlSm" required name="nom" class="form-control form-control-sm" value="<?php echo (!empty($id) && $etudiant2 !== null) ? $etudiant2['nom'] : ''; ?>" />
                <label class="form-label" for="formControlSm">Nom de l'étudiant</label>
            </div>
            <div class="form-outline" data-mdb-input-init>
                <input type="text" id="formControlSm" required name="postnom" class="form-control form-control-sm" value="<?php echo (!empty($id) && $etudiant2 !== null) ? $etudiant2['postnom'] : ''; ?>" />
                <label class="form-label" for="formControlSm">Postnom de l'étudiant</label>
            </div>
            <div class="form-outline" data-mdb-input-init>
                <input type="text" id="formControlSm" required name="prenom" class="form-control form-control-sm" value="<?php echo (!empty($id) && $etudiant2 !== null) ? $etudiant2['prenom'] : ''; ?>" />
                <label class="form-label" for="formControlSm">Prénom de l'étudiant</label>
            </div>
            <div class="form-outline" data-mdb-input-init>
                <input type="text" id="formControlSm" name="matricule" required class="form-control form-control-sm" value="<?php echo (!empty($id) && $etudiant2 !== null) ? $etudiant2['matricule'] : ''; ?>" />
                <label class="form-label" for="formControlSm">Matricule de l'étudiant</label>
            </div>
            <div class="" data-mdb-input-init>
                <label class="form-label" for="formControlSm">Promotion de l'étudiant</label>
                <select name="promotion" class="form-control required form-control-sm">
                    <option value="L1 A">L1 A</option>
                    <option value="L1 B">L1 B</option>
                    <option value="L2 A">L2 A</option>
                    <option value="L2 B">L2 B</option>
                    <option value="L3 MSI">L3 MSI</option>
                    <option value="L3 GL">L3 GL</option>
                    <option value="L3 DESIGN">L3 DESIGN</option>
                    <option value="L3 TELECOM">L3 TELECOM</option>
                    <option value="L3 AS">L3 AS</option>
                    <option value="L4 MSI">L4 MSI</option>
                    <option value="L4 DESIGN">L4 DESIGN</option>
                    <option value="L4 GL">L4 GL</option>
                    <option value="L4 TELECOM">L4 TELECOM</option>
                    <option value="L4 AS">L4 AS</option>
                </select><br>
            </div>
            <div class="" data-mdb-input-init>
                <label class="form-label fw-lighter" for="formControlSm">Genre</label>
                <select name="genre" required class="form-control form-control-sm">
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select><br>
            </div>

            <?php if (!empty($id)){ ?>
                <button class="btn btn-info" name="modifier">
                    Modifier
                </button>
            <?php }else{ ?>
                <button class="btn btn-info" name="ajouter">
                    Ajouter
                </button>
            <?php } ?>
        </form>
    </div>

<!-- MDB -->
<script
    type="text/javascript"
    src="mdb.min.js"
></script>
</body>
</html>
