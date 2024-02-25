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
<div class="container">

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="AccueilComptable.php">Galaxy Swiss Bourdin</a>


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
    <!-- Allow to change the navBar on mobile Devices -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto" ">

            <li class="nav-item">
                <a class="nav-link " href="AccueilComptable.php"><strong>Accueil</strong></a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-warning" href="ValiderFicheFraisComptable.php"><strong>Valider les Fiches</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="Deconnexion.php"><strong>Déconnexion</strong></a>
            </li>
        </ul>
    </div>
</nav>


<!-- Hero Section -->
<div class="jumbotron">
    <h1 class="display-3 text-center"> Bienvenue Comptable !</h1>
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
