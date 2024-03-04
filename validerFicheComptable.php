<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Swisspharma | Accueil Comptable</title>
    <link rel="icon" href="../Ressources/Logo.png"/>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="container-fluid">

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="AccueilComptable.php">swisspharma</a>


    <!-- Afficher le nom et prenom de l'utilisateur -->
    <?php
    
    session_start();
    if($_SESSION["autoriser"] != "oui")
    {
        header("location:index.php");
        exit();
    }
    echo '<a class="navbar-text text-warning" ><i class="fas fa-user-tie  mr-1"></i> Comptable : '.$_SESSION["nom"].' '.$_SESSION["prenom"]. '</a';


    ?>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto" ">

            <li class="nav-item">
                <a class="nav-link " href="AccueilComptable.php"><strong>Accueil</strong></a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-warning" href="validerFicheComptable.php"><strong>Valider les Fiches</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="Deconnexion.php"><strong>Déconnexion</strong></a>
            </li>
        </ul>
    </div>
</nav>


<!-- Hero Section -->
        <div class="jumbotron" style="background-color: #3498db; color: #ffffff;">
            <h1 class="display-4 text-center">Valider fiche de frais</h1>
        </div>

        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-light p-4 mb-4">
                <h4 class="mb-3">Fiche de frais du mois de [Periode]</h4>
                <ul class="list-group mb-4">
                    <li class="list-group-item">Etat: [Etat Libelle]</li>
                    <li class="list-group-item">Dernière modification le: [Date Modification]</li>
                    <li class="list-group-item">Montant validé: [Montant Validé]</li>
                </ul>
                <h4>Quantités des éléments forfaitisés</h4>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Forfait Etape
                        <span class="badge bg-primary rounded-pill">[Quantité Forfait Etape]</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Frais Kilométrique
                        <span class="badge bg-primary rounded-pill">[Quantité Frais Kilométrique]</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nuitée Hôtel
                        <span class="badge bg-primary rounded-pill">[Quantité Nuitée Hôtel]</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Repas Restaurant
                        <span class="badge bg-primary rounded-pill">[Quantité Repas Restaurant]</span>
                    </li>
                </ul>
                <h4>Descriptif des éléments hors forfait - [Nombre Justificatifs] justificatifs reçus </h4>
                
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success me-2">Valider</button>
                    <button class="btn btn-secondary">Effacer</button>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Footer -->
        <footer>
            <div class="card-body text-center bg-primary mt-2">
                <span class="text-light">Swisspharma, Copyright &copy; SYLLA Oumar, Mathis Castell, Rasoarisoa  Bayrone</span>
            </div> 
        </footer> 
    </div>

</body>
</html>
