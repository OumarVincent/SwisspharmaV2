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

function getTypeVehicule($base, $matricule) {
    $requete = "SELECT type_vehicule FROM employe WHERE matricule = :matricule";

    try {
        $statement = $base->prepare($requete);
        $statement->bindValue(':matricule', $matricule);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['type_vehicule'] ?? null;
    } catch (PDOException $e) {
        die('Erreur lors de la récupération du type de véhicule : ' . $e->getMessage());
    }
}

function getFraisForfaitIdBasedOnVehiculeType($typeVehicule) {
    // mapping type de véhicule vers idfraisforfait pour que cela correspond aux données de la base (solution temporaire)
    $mapping = [
        'Frais Kilométrique 4CV Diesel' => ['FK4D'],
        '5/6CV Diesel' => ['FK56D'],
        'Frais Kilométrique 4CV Essence' => ['FK4E'],
        'Frais Kilométrique 5/6CV Essence' => ['FK56E'],
    ];

    return $mapping[$typeVehicule] ?? [];
}

function calculateMontantValideForfait($base, $matricule, $moisAnnee) {
    // Récupère le type de véhicule de l'employé
    $typeVehicule = getTypeVehicule($base, $matricule);
    // Identifie les IDs de frais forfait basés sur le type de véhicule
    $typeVehiculeFraisForfaitIds = getFraisForfaitIdBasedOnVehiculeType($typeVehicule);

    // Transforme les IDs de frais forfait en chaîne pour la requête SQL
    // Ajoute une vérification pour inclure tous les frais sauf ceux liés au véhicule si l'employé n'en a pas
    $idfraisforfaitIn = empty($typeVehicule) ? "'NUI', 'REP', 'RE'" : "'" . implode("','", $typeVehiculeFraisForfaitIds) . "'";

    $requete = "SELECT SUM(fraisforfait.montant * lignefraisforfait.quantite) AS montantValideForfait
                FROM lignefraisforfait
                JOIN fraisforfait ON lignefraisforfait.idfraisforfait = fraisforfait.id
                WHERE lignefraisforfait.matricule = :matricule
                AND lignefraisforfait.moisAnnee = :moisAnnee
                AND (lignefraisforfait.idfraisforfait IN ($idfraisforfaitIn) 
                     OR lignefraisforfait.idfraisforfait NOT IN ('FK4D', 'FK56D', 'FK4E', 'FK56E'))";

    try {
        $statement = $base->prepare($requete);
        $statement->bindValue(':matricule', $matricule);
        $statement->bindValue(':moisAnnee', $moisAnnee);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result ? ($result['montantValideForfait'] ?: 0) : 0;
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

// fonction compatable  : 




?>
