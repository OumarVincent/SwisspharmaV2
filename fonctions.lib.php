<?php
require(__DIR__ . '/database/database.inc.php');

function addLigneFraisForfait($base, $idfraisforfait, $quantite,) {
    $requete = "INSERT INTO lignefraisforfait (matricule, moisAnnee, idfraisforfait, quantite) 
                VALUES (:matricule, :moisAnnee, :idfraisforfait, :quantite)";

    try {
        $statement = $base->prepare($requete);
        $statement->bindValue(':matricule', $_SESSION["matricule"]);
        $statement->bindValue(':moisAnnee', date('Ym'));
        $statement->bindValue(':idfraisforfait', $idfraisforfait);
        $statement->bindValue(':quantite', $quantite);
        $statement->execute();
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
    }
}

function addLigneFraisHorsForfait($base, $matricule, $dateHF, $montant, $libelle,) {
    $requete = "INSERT INTO lignefraishorsforfait (matricule, moisAnnee, dateHF, montant, libelle)
                VALUES (:matricule, :moisAnnee, :dateHF, :montant, :libelle)";

    try {
        $statement = $base->prepare($requete);
        $statement->bindValue(':matricule', $matricule);
        $statement->bindValue(':moisAnnee', date('Ym'));
        $statement->bindValue(':dateHF', $dateHF);
        $statement->bindValue(':montant', $montant);
        $statement->bindValue(':libelle', $libelle);
        $statement->execute();
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
    }
}

function addFicheFrais($base, $matricule, $nbJustificatifs) {
    $moisAnnee = date('Ym');

    // Ajout de la fiche de frais sans le montant valide
    $requete = "INSERT INTO fichefrais (matricule, moisAnnee, nbjustificatifs, datemodif, idetat)
                VALUES (:matricule, :moisAnnee, :nbJustificatifs, NOW(), 'CR')";

    try {
        $statement = $base->prepare($requete);
        $statement->bindValue(':matricule', $matricule);
        $statement->bindValue(':moisAnnee', $moisAnnee);
        $statement->bindValue(':nbJustificatifs', $nbJustificatifs);
        $statement->execute();
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
    }
}

function setMontantValide($base, $matricule, $moisAnnee) {
    $montantValideForfait = calculateMontantValideForfait($base, $matricule, $moisAnnee);
    $montantValideHorsForfait = calculateMontantValideHorsForfait($base, $matricule, $moisAnnee);
    $montantValideTotal = $montantValideForfait + $montantValideHorsForfait;

    $requete = "UPDATE fichefrais
                SET montantvalide = :montantValideTotal
                WHERE matricule = :matricule
                AND moisAnnee = :moisAnnee";

    try {
        $statement = $base->prepare($requete);
        $statement->bindValue(':montantValideTotal', $montantValideTotal);
        $statement->bindValue(':matricule', $matricule);
        $statement->bindValue(':moisAnnee', $moisAnnee);
        $statement->execute();
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
    }
}

function calculateMontantValideForfait($base, $matricule) {
    $requete = "SELECT SUM(fraisforfait.montant * lignefraisforfait.quantite) AS montantValideForfait
                FROM lignefraisforfait
                JOIN fraisforfait ON lignefraisforfait.idfraisforfait = fraisforfait.id
                WHERE lignefraisforfait.matricule = :matricule
                AND lignefraisforfait.moisAnnee = :moisAnnee";

    try {
        echo "Matricule avant la requête: $matricule, MoisAnnée avant la requête: " . date('Ym') . "<br>";

        $statement = $base->prepare($requete);
        $statement->bindValue(':matricule', $matricule, PDO::PARAM_STR);
        $statement->bindValue(':moisAnnee', date('Ym'), PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['montantValideForfait'] ?: 0;
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
    }
}


function calculateMontantValideHorsForfait($base, $matricule) {
    $requete = "SELECT SUM(montant) AS montantValideHorsForfait
                FROM lignefraishorsforfait
                WHERE matricule = :matricule
                AND moisAnnee = :moisAnnee";

    try {
        $statement = $base->prepare($requete);
        $statement->bindValue(':matricule', $matricule);
        $statement->bindValue(':moisAnnee',date('Ym') );
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['montantValideHorsForfait'] ?: 0;
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
    }
}

function addHorsClassification($base, $matricule, $nbJustificatifs, $libelle) {

    $requete = "INSERT INTO fichefrais (matricule, moisAnnee, nbjustificatifs, montantvalide)
                VALUES (:matricule, :moisAnnee, :nbJustificatifs, :montantValide)
                ON DUPLICATE KEY UPDATE nbjustificatifs = :nbJustificatifs, montantvalide = :montantValide";

    try {
        $montantValide = calculateMontantValide($base, $matricule);

        $statement = $base->prepare($requete);
        $statement->bindValue(':matricule', $matricule);
        $statement->bindValue(':moisAnnee', date('Ym'));
        $statement->bindValue(':nbJustificatifs', $nbJustificatifs);
        $statement->bindValue(':montantValide', $montantValide);
        $statement->execute();
    } catch (PDOException $e) {
        die('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
    }
}



?>
