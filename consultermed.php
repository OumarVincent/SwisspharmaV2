<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swisspharma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php require(__DIR__ . '/database/database.inc.php');?>
    <div class="container-fluid">
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
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link " href="index.php"><strong>Accueil</strong></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-warning" href="fraismed.php#Saisie"><strong>Saisir</strong></a>
					</li>

					<li class="nav-item">
						<a class="nav-link text-warning" href="consultermed.php#Consultation"><strong>Consulter</strong></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-danger" href="Deconnexion.php"><strong>Déconnexion</strong></a>
					</li>
				</ul>
			</div>
		</nav>

        <div class="jumbotron" style="background-color: #3498db; color: #ffffff;">
            <h1 class="display-4 text-center">Consulter fiche de frais</h1>
        </div>

        <div class="row">
	
			<div class="col-sm-12 col-md-4">
			<div class="card mb-4 shadow"> <!-- Ajout de l'ombre pour plus de profondeur -->
        <div class="card-body">
            <h3 class="card-title text-center">Période à sélectionner</h3>
            <form name="validerPeriodeForm" id="validerPeriodeForm" method="post" action="">
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

							<div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    			<button type="reset" class="btn btn-outline-warning mb-3 mt-3"><i class="fas fa-times"></i> Annuler</button>
                    			<button type="submit" class="btn btn-outline-success mb-3 mt-3" name="okPeriode" value="Valider"><i class="fas fa-check"></i> Valider</button>
                			</div>
						</form>
					</div>
				</div>
                
			</div
            ><?php include("consulterVisiteur.inc.php");?>
    </div>
    <footer class="card-body text-center bg-primary mt-2">
            <span class="text-light">Swisspharma, Copyright &copy; SYLLA Oumar, Mathis Castell, Rasoarisoa  Bayrone</span>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>