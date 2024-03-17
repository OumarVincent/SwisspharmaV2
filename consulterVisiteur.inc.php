<?php 
if(isset($_POST['okPeriode']) and $_POST['okPeriode'] != '')
{
try {
    $month = 'null';
    $year = 'null';

    $periode = $_POST['periode'];
    // Découper le mois et l'année dans les deux variables month et year.
    foreach ($monthArray as $value => $_month) {
        if (strpos($periode, $_month) !== false)
            $month = $value;
    }

    foreach ($yearArray as $_year) {
        if (strpos($periode, (string)$_year) !== false) {
            $year = $_year;
        }
    }

    $datePourRequete = 'null';
    if ($month == 'null')
        $datePourRequete = $periode;
    else
        $datePourRequete = $year . $month;

    $_SESSION['periode'] = $datePourRequete;

// Requête pour la fiche frais.
$stmtFicheFrais = $pdo->prepare('SELECT * FROM fichefrais WHERE matricule = :matricule AND moisAnnee = :datePourRequete');
$stmtFicheFrais->execute(['matricule' => $_SESSION['matricule'], 'datePourRequete' => $datePourRequete]);
$ligne = $stmtFicheFrais->fetch();

// Requête pour le libellé de l'état.
if (isset($ligne['idetat'])) {
    $stmtEtat = $pdo->prepare('SELECT libelle FROM etat WHERE id = :idetat');
    $stmtEtat->execute(['idetat' => $ligne['idetat']]);
    $etat = $stmtEtat->fetch();
}

// Requête optimisée pour récupérer tous les frais forfaitaires en une seule fois.
$stmtFraisForfait = $pdo->prepare('SELECT * FROM lignefraisforfait WHERE matricule = :matricule AND moisAnnee = :datePourRequete AND idfraisforfait IN (\'RE\', \'NUI\', \'REP\', \'FK4D\', \'FK4E\', \'FK56D\', \'FK56E\')');
$stmtFraisForfait->execute(['matricule' => $_SESSION['matricule'], 'datePourRequete' => $datePourRequete]);
$fraisForfaitaires = $stmtFraisForfait->fetchAll();

// Traitement des différents frais forfaitaires
foreach ($fraisForfaitaires as $frais) {
    switch ($frais['idfraisforfait']) {
        case 'RE':
            $forfaitEtape = $frais;
        break;
        case 'FK4D':
        case 'FK4E':
        case 'FK56D':
        case 'FK56E':
            $fraisKilometrique = $frais;
        break;
        case 'NUI':
            $nuiteeHotel = $frais;
            break;
        case 'REP':
            $repasRestaurant = $frais;
            break;
    }
}

// Requête pour lignefraishorsforfait.
$stmtFraisHorsForfait = $pdo->prepare('SELECT * FROM lignefraishorsforfait WHERE matricule = :matricule AND moisAnnee = :datePourRequete');
$stmtFraisHorsForfait->execute(['matricule' => $_SESSION['matricule'], 'datePourRequete' => $datePourRequete]);
$fraisHorsForfait = $stmtFraisHorsForfait->fetchAll();

// Le traitement ultérieur du résultat de $fraisHorsForfait, si nécessaire.

  

    if (isset($ligne['idetat'])) {
        if (count($fraisHorsForfait) > 0) {
            echo '<div class="col-md-8">
                <div class="bg-light p-4 mb-4">
                    <h4 class="mb-3">Fiche de frais du mois de ' . $periode . '</h4>
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
                    <h4>Descriptif des éléments hors forfait - ' . $ligne['nbjustificatifs'] . ' justificatif reçus </h4>
                    <div class="d-flex flex-column mb-3">';

                    foreach ($fraisHorsForfait as $donnee) {
                        echo '<div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                ' . $donnee['dateHF'] . ' - ' . $donnee['libelle'] . ': ' . $donnee['montant'] . '
                                <form method="post" action="">
                                    <input type="hidden" name="supprimerHorsForfait" value="' . $donnee['id'] . '">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Supprimer
                                    </button>
                                </form>
                              </div>';
                    }                    

            echo '</div>
                </div>
            </div>';
        } else {
            echo '<div class="col-md-8"><div class="bg-light p-4 text-center">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Attention!</h4>
                    <p>Aucune fiche de frais pour le mois de ' . $periode . '.</p>
                </div>
                </div></div>';
        }
    } else {
        // Gestion si $ligne['idetat'] n'est pas défini
        echo '<div class="col-md-8"><div class="bg-light p-4 text-center">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erreur!</h4>
                <p>La fiche de frais spécifiée est introuvable ou invalide.</p>
            </div>
            </div></div>';
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion !';
    die();
}

if (isset($_POST['supprimerHorsForfait']) and $_POST['supprimerHorsForfait'] != '') {
    $idToDelete = $_POST['supprimerHorsForfait'];
    $requeteSupprimer = "DELETE FROM lignefraishorsforfait WHERE id = $idToDelete";
    $pdo->query($requeteSupprimer);
    
    echo '<div class="col-md-8"><div class="bg-light p-4 text-center">
          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Succès!</h4>
            <p>La ligne de frais hors forfait a bien été supprimée.</p>
          </div>
          </div></div>';
}
}
?>
