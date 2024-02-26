<?php
session_start();
require(__DIR__ . '/database/database.inc.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $login = $_POST['username'];
    $login = $pdo->quote($login);

    $password = $_POST['password'];
    $password = $pdo->quote($password);

    $sql = "SELECT nom, prenom, login, mdp, idRole, matricule FROM employe WHERE login=$login AND mdp=$password";
    $result = $pdo->query($sql);
    $num = $result->rowCount();
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($num != 0 AND $row['idRole'] == 0) {
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION["matricule"] = $row['matricule'];
        $_SESSION["autoriser"] = "oui";
        header('Location:  AccueilVisiteur.php');
        exit(); 
    }else if($num != 0 AND $row['idRole'] == 1){
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION["matricule"] = $row['matricule'];
        $_SESSION["autoriser"] = "oui";
        header('Location:  AccueilComptable.php');
        exit();
    }
     else {
        $_SESSION["autoriser"] = "non";
        echo "<script>alert('Identifiants incorrects');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="index.php">&nbsp&nbsp Swisspharma</a>

			<!-- Allow to change the navBar on mobile Devices -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			    <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto" >
					<li class="nav-item">
						<a class="nav-link" href="index.php">Accueil</a>
					</li>


					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
							Connexion 
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="login.php"><i class="fas fa-user mr-2"></i>Visiteur&Comptable </a>
						</div>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="Contact.php">Contact</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="APropos.php">A propos</a>
					</li>

				</ul>

			</div>
		</nav>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Bienvenue !</h2>
                <!--<div class="text-center mb-5 text-dark">Connectez vous</div>-->
                <div class="card my-5">

                    <form action ="login.php" method="POST" class="card-body cardbody-color p-lg-5">

                        <div class="text-center">
                            <img src="images/LogoSwissPharma.png"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>
                        <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="User Name">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="password">
                        </div>
                        <div class="text-center"><button type="submit"
                                class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                    </form>
                </div>

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