<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre site e-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="CSS/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>-->
</head>

<body>
<?php include('fonctions.lib.php'); ?>
    <div class="container-fluid"> <!-- Header-->

        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="index.php">&nbsp&nbsp Swisspharma</a>
            <!-- Afficher le nom et prenom de l'utilisateur -->
            <?php
			
			session_start();
			if($_SESSION["autoriser"] != "oui")
			{
				header("location:index.php");
				exit();
			}

			echo '<a class="navbar-text text-info" ><i class="fa fa-user" aria-hidden="true"></i> Visiteur : '.$_SESSION["nom"].' '.$_SESSION["prenom"]. '</a';
            

			?>

            <!-- Permet de change la navBar sur les smartphones -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto" ">
					<li class=" nav-item">
                    <a class="nav-link " href=" AccueilVisiteur.php"><strong>Accueil</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="fraismed.php#Saisie"><strong>Saisir</strong></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-warning"
                            href="consultermed.php#Consultation"><strong>Consulter</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="Deconnexion.php"><strong>Déconnexion</strong></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="jumbotron" style="background-color: #3498db; color: #ffffff;">
            <h1 class="display-4 text-center">Saisie de fiche de frais</h1>
        </div>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        
        if (isset($_POST["repas"]) && isset($_POST["nuitees"]) && isset($_POST["etapes"]) && isset($_POST["km"]) &&
            $_POST["repas"] !== '' && $_POST["nuitees"] !== '' && $_POST["etapes"] !== '' && $_POST["km"] !== '') {
            
            
            $repas = $_POST["repas"];
            $nuitees = $_POST["nuitees"];
            $etapes = $_POST["etapes"];
            $km = $_POST["km"];
            
            addFicheFrais($pdo, $_SESSION['matricule'], $_POST['hc-nb']);
            addLigneFraisForfait($pdo, 'REP', $repas);
            addLigneFraisForfait($pdo, 'NUI', $nuitees);
            addLigneFraisForfait($pdo, 'RE', $etapes);
            switch(getTypeVehicule($pdo,$_SESSION['matricule'])) {
                case 'FK4D':
                    addLigneFraisForfait($pdo, 'FK4D', $km);
                break;
                case 'FK4E':
                    addLigneFraisForfait($pdo, 'FK4E', $km);
                break;
                case 'FK56D': 
                    addLigneFraisForfait($pdo, 'FK56D', $km);
                break;
                case 'FK56E':
                    addLigneFraisForfait($pdo, 'FK56E', $km);
                break;
            }
            
            
            echo '<div class="alert alert-success" role="alert">Les données ont été enregistrées avec succès.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Veuillez remplir tous les champs obligatoires.</div>';
        }
        
        if (isset($_POST['hfmtn_1']) && isset($_POST['hflibelle_1']) && isset($_POST['hfdate_1']) &&
            $_POST['hfmtn_1'] !== '' && $_POST['hflibelle_1'] !== '' && $_POST['hfdate_1'] !== '') {
            
            // Récupérer les valeurs des champs
            $hfdate_1 = $_POST['hfdate_1'];
            $hflibelle_1 = $_POST['hflibelle_1'];
            $hfmtn_1 = $_POST['hfmtn_1'];
    
            // Appeler la fonction pour ajouter une ligne de frais hors-forfait à la base de données
            addLigneFraisHorsForfait($pdo, $_SESSION['matricule'], $hfdate_1, $hfmtn_1 , $hflibelle_1);
            
            echo '<div class="alert alert-success" role="alert">Les frais hors-forfait ont été enregistrés avec succès.</div>';
        } else {
            // Gérer le cas où les champs n sont pas définis vides ou égaux à l'espace
            echo '<div class="alert alert-danger" role="alert">Veuillez remplir tous les champs obligatoires.</div>';
        }
    } 
    
    // Mettre à jour le montant valide
    setMontantValide($pdo, $_SESSION['matricule'], date('Ym'));
    ?>


        <!-- Contenu du formulaire -->
        <div id="myTabContent" class="tab-content ">
            <!-- Onglet Ajouter -->
            <div class="tab-pane active" id="ajouter">
                <div class="mx-auto mt-5" style="width: 50%;">
                    <form id="formajouter" class="form-horizontal" action="fraismed.php" method="POST">
                        <!-- Contrôles Frais au forfait -->
                        <legend>Frais au forfait <span id="infoover" class="icon-warning-sign"
                                data-original-title=""></span></legend>
                        <div class="form-group">
                            <label for="repas">Repas</label>
                            <input type="number" min="0" class="form-control" id="repas" name="repas"
                                placeholder="Repas">
                        </div>
                        <div class="form-group">
                            <label for="nuitees">Nuitées</label>
                            <input type="number" min="0" class="form-control" id="nuitees" name="nuitees"
                                placeholder="Nuitées">
                        </div>
                        <div class="form-group">
                            <label for="etapes">Étapes</label>
                            <input type="number" min="0" class="form-control" id="etapes" name="etapes"
                                placeholder="Étapes">
                        </div>
                        <div class="form-group">
                            <label for="km">Kilomètres</label>
                            <input type="number" min="0" class="form-control" id="km" name="km"
                                placeholder="Kilomètres">
                        </div>
                        <!-- Contrôles Hors forfait -->
                        <legend>Frais hors-forfait</legend>
                        <div class="form-group">
                            <label for="hfdate_1">Date</label>
                            <input type="date" class="form-control" id="hfdate_1" name="hfdate_1">
                        </div>
                        <div class="form-group">
                            <label for="hflibelle_1">Libellé</label>
                            <input type="text" class="form-control" id="hflibelle_1" name="hflibelle_1"
                                placeholder="Libellé">
                        </div>
                        <div class="form-group">
                            <label for="hfqte_1">Montant €</label>
                            <input type="number" min="0" class="form-control" id="hfmtn_1" name="hfmtn_1"
                                placeholder="Montant">
                        </div>
                        <br><button class="btn btn-info clicktoadd" type="button" data-count="1">Ajouter
                            Hors-forfait</button><br><br>
                        <legend>Hors classification</legend>
                        <div class="form-group">
                            <label for="hc-nb">Nombre justificatifs</label>
                            <input type="number" min="0" class="form-control" id="hc-nb" name="hc-nb"
                                placeholder="Nombre justificatifs">
                        </div>
                        <div class="form-group">
                            <label for="hc-lib">Libellé</label>
                            <input type="text" class="form-control" id="hc-lib" name="hc-lib" placeholder="Libellé">
                        </div>
                        <br>
                        <!-- Autres contrôles (étapes, kilomètres, justificatifs) -->
                         
                        <!-- Bouton Enregistrer -->
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </form>
                </div>
            </div>

            <!-- Onglet Modifier -->
            <div class="tab-pane" id="modifier">
                <!-- Contenu de l'onglet Modifier -->
                 
            </div>
        </div>
        <div class="card-body text-center bg-primary mt-2 ">
            <span class=" text-light ">Swisspharma, Copyright &copy; SYLLA Oumar, Mathis Castell, Rasoarisoa
                 Bayrone</span>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>
