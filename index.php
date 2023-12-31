<?php
    //====================== CONNECTION A MA BD UDBL =====================
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "UDBL";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
//===========================================================================
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des étudiants</title>
    <!-- INCLUSION DES FICHIERS DE STYLE DE BOOTSTRAP MDB DISPO SUR https://mdbootstrap.com/ -->
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
    <!-- EN LOCAL -->
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
    <!-- CODE DE L'AFFICHAGE DE LA PAGE PRINCIPALE -->
    <div class="container mt-5">
        <h1 class="fw-light">Liste des étudiants</h1>
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="row w-100 mb-5 mt-5">
                <div class="col-2">
                    <!-- FONCTIONNALITE ADDITIONNEL DE TRI -->
                    <form action="" method="get" class="d-flex justify-content-between gap-2">
                        <select name="sort" id="" class="btn btn-outline-info btn-sm" data-mdb-ripple-init data-mdb-ripple-color="dark">
                            <option value="">Trié par ordre</option>
                            <option value="ASC">Ascendant</option>
                            <option value="DESC">Déscendant</option>
                        </select>
                        <button class="btn btn-sm btn-info">Trié</button>
                    </form>
                </div>
                <div class="col-6"></div>
                <div class="col-4">
                    <!-- PREMIERE FONCTIONNALITE DU CRUD : INSERTION OU CREATION D'UN NOUVEL ETUDIANT -->
                    <div class="d-flex justify-content-end">
                        <a href="form.php" class="btn btn-info text-sm fw-light mt-4">Ajouter un étudiant</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- DEUXIEME FONCTIONNALITE DU CRUD : READ OU AFFICHAGE DE LA LISTE DES ETUDIANTS -->
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th class="fw-normal">ID</th>
                    <th class="fw-normal">Nom</th>
                    <th class="fw-normal">Postnom</th>
                    <th class="fw-normal">Prénom</th>
                    <th class="fw-normal">Matricule</th>
                    <th class="fw-normal">Genre</th>
                    <th class="fw-normal">Promotion</th>
                    <th class="text-end fw-normal">Action</th>
                </tr>
            </thead>
            <tbody>
            <!-- FONCTIONNALITE ADDITIONNEL DE TRI ASCENDANT, DESCENDANT ET AFFICHAGE NORMAL -->
                <?php if (isset($_GET['sort']) && $_GET['sort'] === 'ASC'){
                    $sql = "SELECT * FROM Etudiant ORDER BY nom ASC";
                    $query = $conn->query($sql);
                    $etudiants = $query->fetchAll();
                }elseif (isset($_GET['sort']) && $_GET['sort'] === 'DESC'){
                    $sql = "SELECT * FROM Etudiant ORDER BY nom DESC";
                    $query = $conn->query($sql);
                    $etudiants = $query->fetchAll();
                }else{
                    $sql = "SELECT * FROM Etudiant";
                    $query = $conn->query($sql);
                    $etudiants = $query->fetchAll();
                } ?>
                <?php foreach ($etudiants as $etudiant){ ?>
                    <tr>
                        <td class="fw-light"><?php echo $etudiant['id'] ?></td>
                        <td class="fw-light"><?php echo $etudiant['nom'] ?></td>
                        <td class="fw-light"><?php echo $etudiant['postnom'] ?></td>
                        <td class="fw-light"><?php echo $etudiant['prenom'] ?></td>
                        <td class="fw-light"><?php echo $etudiant['matricule'] ?></td>
                        <td class="fw-light"><?php echo $etudiant['genre'] ?></td>
                        <td class="fw-light"><?php echo $etudiant['promotion'] ?></td>
                        <td>
                            <div class="w-100 d-flex justify-content-end gap-2">

                                <!-- TROISIEME FONCTIONNALITE DU CRUD : UPDATE OU MODIFICATION D'UN ETUDIANT -->
                                <a href="form.php?id=<?php echo $etudiant['id'] ?>" class="btn btn-info btn-sm fw-light">Modifier</a>

                                <!-- QUATRIEME FONCTIONNALITE DU CRUD : DELETE OU SUPPRESSION D'UN ETUDIANT -->
                                <a href="crud.php?id_suppr=<?php echo $etudiant['id'] ?>" class="btn btn-danger btn-sm fw-light" name="id_suppr">Supprimer</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- MDB EN LIGNE -->
    <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"
    ></script>
    <!-- IMPORTATION DU FICHIER JAVASCRIPT DE MDB EN LOCAL -->
    <script
            type="text/javascript"
            src="mdb.min.js"
    ></script>
</body>
</html>
