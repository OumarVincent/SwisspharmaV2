<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Swisspharma | Accueil Comptable</title>
    <link rel="icon" href="../Ressources/Logo.png"/>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="AccueilComptable.php">Swisspharma</a>
        <?php include('fonctions.lib.php');
        session_start();

        if($_SESSION["autoriser"] != "oui") {
            header("location:index.php");
            exit();
        }
        echo '<a class="navbar-text text-warning"><i class="fas fa-user-tie mr-1"></i> Comptable : '.$_SESSION["nom"].' '.$_SESSION["prenom"].'</a>';
        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="AccueilComptable.php"><strong>Accueil</strong></a></li>
                <li class="nav-item"><a class="nav-link text-warning" href="validerFicheComptable.php"><strong>Valider les Fiches</strong></a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="Deconnexion.php"><strong>Déconnexion</strong></a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="jumbotron" style="background-color: #3498db; color: #ffffff;">
        <h1 class="display-4 text-center">Valider fiche de frais</h1>
    </div>

    <!-- Main content --><div class="container mt-5">
<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="card mb-4 shadow"> <!-- Ajout d'ombre pour plus de profondeur -->
            <div class="card-body">
                <h3 class="card-title text-center">Période & Employé à sélectionner</h3>
                <form name="validationForm" id="validationForm" method="post" action="">
                    <div class="mb-3">
                        <label for="periode" class="form-label">Période</label> <!-- Utilisation de label pour une meilleure accessibilité -->
                        <select class="form-select" name="periode" id="periode">

									<?php
										$yearArray = range(date('Y'), 2010);
										$monthArray = array(
											'01' => 'Janvier', '02' => 'Février', '03' => 'Mars',
											'04' => 'Avril', '05' => 'Mai', '06' => 'Juin',
											'07' => 'Juillet', '08' => 'Août', '09' => 'Septembre',
											'10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre', 
											);


										foreach ($yearArray as $year) {
											foreach ($monthArray as $month) {

												echo '<option>'.$month.' '.$year.'</option>';
											}
										}
									?>
								</select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="visiteur" class="form-label">Employé</label>
                        <select class="form-select" name="nomPrenomVisiteur" id="visiteur">
                            <?php
                            $pdo=new PDO('mysql:host=localhost;dbname=swisspharma;charset=utf8', 'root', '');
                            $requete = 'SELECT nom, prenom FROM employe WHERE idRole = 0';  
                            $execution = $pdo->query($requete);
                            while($ligne = $execution->fetch()) {
                                echo "<option value='{$ligne['nom']} {$ligne['prenom']}'>{$ligne['nom']} {$ligne['prenom']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type="reset" class="btn btn-outline-warning mb-3"><i class="fas fa-times"></i> Annuler</button>
                        <button type="submit" class="btn btn-outline-success mb-3" name="okPeriode" value="Valider"><i class="fas fa-check"></i> Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>


    <?php
        if(isset($_POST['okPeriode']) and $_POST['okPeriode'] != '')
        {
            

            try
            {
                $periode = $_POST['periode'];
                 $pdo=new PDO('mysql:host=localhost;dbname=swisspharma;charset=utf8','root', '');


                $month = 'null';
                $year = 'null';
                
                foreach ($monthArray as $value => $_month) {
                    if(strpos($periode, $_month) !== false) 
                        $month = $value;
                }

                foreach ($yearArray as $_year )
                {
                    if(strpos($periode, (string)$_year) !== false)
                    {
                        $year = $_year;
                    }
                }

                
                $_SESSION['periode'] = $year.$month;

                $nomVisiteur = '';
                $prenomVisiteur = '';
                $nomPrenomVisiteur = $_POST['nomPrenomVisiteur'];

                // On découpe le nom et le prénom que l'on met dans deux variables distinctes.
                for ($i = 0; $i < strlen($nomPrenomVisiteur) ; $i++) {
                    if ($nomPrenomVisiteur[$i] == ' ') 
                        break;

                    $nomVisiteur = $nomVisiteur.$nomPrenomVisiteur[$i];
                    
                }

                for ($i=strlen($nomVisiteur) + 1; $i < strlen($nomPrenomVisiteur); $i++) { 
                    $prenomVisiteur = $prenomVisiteur.$nomPrenomVisiteur[$i];
                }
                $requete = "SELECT matricule,type_vehicule FROM employe WHERE nom = '$nomVisiteur' AND prenom = '$prenomVisiteur'";
                $execution = $pdo->query($requete);
                $ligne = $execution->fetch();
                $_SESSION['matricule_visiteur'] = $ligne['matricule'];
                $_SESSION["type_vehicule"] = $ligne['type_vehicule'];
                
                
                // Requête pour la fiche frais
                $moisAnnee = $year . str_pad($month, 2, "0", STR_PAD_LEFT);
                $requete = "SELECT * FROM fichefrais WHERE matricule = '{$_SESSION['matricule_visiteur']}' AND moisAnnee = '$moisAnnee'";
                $execution = $pdo->query($requete);
                $ligne = $execution->fetch();
                
                // Requête pour le libellé de l'état
                $requete = "SELECT libelle FROM etat WHERE id = '{$ligne['idetat']}'";
                $execution = $pdo->query($requete);
                $etat = $execution->fetch();
                
                // Requêtes pour les lignes de frais forfait
                $idFraisForfait = ['RE', 'FK4D', 'FK4E', 'FK56D','FK56E','NUI','REP']; // Identifiants des frais forfait
                // Requête pour ligneFraisForfait Forfait Etape.
                $requeteEtape = "SELECT * FROM lignefraisforfait WHERE matricule = '{$_SESSION['matricule_visiteur']}' AND moisAnnee = '{$moisAnnee}' AND idFraisForfait = 'RE'";
                $executionEtape = $pdo->query($requeteEtape) or die('La requête a planté !');
                $forfaitEtape = $executionEtape->fetch();

                // Requête pour ligneFraisForfait Frais Kilométrique
                $requeteKm = "SELECT * FROM lignefraisforfait WHERE matricule = :matricule AND moisAnnee = :moisAnnee AND idFraisForfait = :typeVehicule";

                
                $stmt = $pdo->prepare($requeteKm);


                $stmt->bindValue(':matricule', $_SESSION['matricule_visiteur'], PDO::PARAM_STR);
                $stmt->bindValue(':moisAnnee', $moisAnnee, PDO::PARAM_STR);
                $stmt->bindValue(':typeVehicule', $_SESSION["type_vehicule"], PDO::PARAM_STR);

 
                $stmt->execute();

                $fraisKilometrique = $stmt->fetch();

 

                // Requête pour ligneFraisForfait Nuitée Hôtel.
                $requeteNuit = "SELECT * FROM lignefraisforfait WHERE matricule = '{$_SESSION['matricule_visiteur']}' AND moisAnnee = '{$moisAnnee}' AND idFraisForfait = 'NUI'";
                $executionNuit = $pdo->query($requeteNuit) or die('La requête a planté !');
                $nuiteeHotel = $executionNuit->fetch();

                // Requête pour ligneFraisForfait Repas Restaurant.
                $requeteRepas = "SELECT * FROM lignefraisforfait WHERE matricule = '{$_SESSION['matricule_visiteur']}' AND moisAnnee = '{$moisAnnee}' AND idFraisForfait = 'REP'";
                $executionRepas = $pdo->query($requeteRepas) or die('La requête a planté !');
                $repasRestaurant = $executionRepas->fetch();
                echo $repasRestaurant['matricule'];
                
                // Requête pour les lignes de frais hors forfait
                $requete = "SELECT * FROM lignefraishorsforfait WHERE matricule = '{$_SESSION['matricule_visiteur']}' AND moisAnnee = '$moisAnnee'";
                $fraisHorsForfait = $pdo->query($requete);
                
                
                if (isset($ligne['idetat'])) {
                    echo '<div class="col-md-8">
        <div class="bg-light p-4 mb-4">
            <h4 class="mb-3">Fiche de frais du mois de ' . $periode . ' | ' . $nomVisiteur . ' ' . $prenomVisiteur . '</h4>
            <ul class="list-group mb-4">
                <li class="list-group-item">Etat: ' . $etat['libelle'] . '</li>
                <li class="list-group-item">Dernière modification le: ' . $ligne['datemodif'] . '</li>
                <li class="list-group-item">Montant validé: ' . $ligne['montantvalide'] . '</li>
            </ul>
            <h4>Quantités des éléments forfaitisés</h4>
            <ul class="list-group mb-4">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Forfait Etape
                    <span class="badge bg-primary rounded-pill">' . $forfaitEtape['quantite'] . '</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Frais Kilométrique
                    <span class="badge bg-primary rounded-pill">' . $fraisKilometrique['quantite'] . '</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Nuitée Hôtel
                    <span class="badge bg-primary rounded-pill">' . $nuiteeHotel['quantite'] . '</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Repas Restaurant
                    <span class="badge bg-primary rounded-pill">' . $repasRestaurant['quantite'] . '</span>
                </li>
            </ul>
            <h4>Descriptif des éléments hors forfait - ' . $ligne['nbjustificatifs'] . ' justificatif(s) reçu(s)</h4>
            <div class="d-flex flex-column mb-3">';
            
        foreach ($fraisHorsForfait as $donnee) {
            echo '<div class="p-2 bg-white border mb-2 d-flex justify-content-between align-items-center">
                    <div>' . $donnee['dateHF'] . ' - ' . $donnee['libelle'] . ' - ' . $donnee['montant'] . '€</div>';
            if($ligne['idetat'] == 'CR') {
                echo '<form id="HorsForfaitForm" name="HorsForfaitForm" method="post" action="">
                        <input type="hidden" name="supprimerHorsForfait" value="' . $donnee['id'] . '">
                        <button type="submit" form="HorsForfaitForm" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>';
            }
            echo '</div>';
        }

        if ($ligne['idetat'] == 'CL') {
            echo '<form id="ValidationForm" name="ValidationForm" method="post" action="" class="mt-3">
                    <button type="submit" class="btn btn-info" name="ValiderFiche" value="ValiderFiche">Valider la fiche</button>
                </form>';
        } else {
            echo '<div class="alert alert-warning" role="alert">
                    Aucune fiche de frais pour le mois de ' . $periode . '.
                </div>';
        }
        echo '</div></div>';

                        }

                    }catch ( PDOEeption $e)
                    {
                        echo ('Erreur de connexion !');
                        die();
                    }
                }
        
        
        if(isset($_POST['supprimerHorsForfait']) and $_POST['supprimerHorsForfait'] != '')
        {
             $pdo=new PDO('mysql:host=localhost;dbname=swisspharma;charset=utf8','root', '');

            
            $requeteRecuperer = 'select libelle from lignefraishorsforfait where id ='.$_POST['supprimerHorsForfait'];
            
            $execution = $pdo->query($requeteRecuperer);
            $libelle = $execution->fetch();
            $requeteSupprimer = "UPDATE lignefraishorsforfait SET libelle = 'REFUSE_" . $libelle['libelle'] . "' WHERE id =" . $_POST['supprimerHorsForfait'];
            $pdo->query($requeteSupprimer);
            echo '<div class="col-md-8"><div class=" card-body text-center alert alert-dismissible alert-success">
                      <button type="button" class="close" data-dismiss="alert">&times;</button><h4>
                      La ligne de frais hors forfait à bien été supprimer !</h4>
                    </div></div>';
        }

        if(isset($_POST['ValiderFiche']) and $_POST['ValiderFiche'] != '')
        {
             $pdo=new PDO('mysql:host=localhost;dbname=swisspharma;charset=utf8','root', '');

            $requeteSupprimer = "UPDATE fichefrais SET idetat = 'VA' WHERE matricule = '" . $_SESSION['matricule_visiteur'] . "' AND moisAnneeAnnee = '" . $_SESSION['periode'] . "'";
            //echo $requeteSupprimer;
            $pdo->query($requeteSupprimer);
            echo '<div class="col-md-8"><div class=" card-body text-center alert alert-dismissible alert-success">
                      <button type="button" class="close" data-dismiss="alert">&times;</button><h4>
                      la fiche de frais à bien été validé !</h4>
                    </div></div>';
        }
    ?>	

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
