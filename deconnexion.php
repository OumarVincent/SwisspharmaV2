<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Swisspharma | Déconnexion </title>
	<link rel="icon" href="../Ressources/Logo.png"/>
	<!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initale-scale=1.0">

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



		<!-- Hero Section -->
		<div class="jumbotron">
			<h1 class="display-3 text-center"> À bientôt !</h1>

		</div>



		<!-- Footer -->
		<footer class="card-body text-center bg-primary mt-2 ">
            <span class=" text-light ">Swisspharma, Copyright &copy; SYLLA Oumar, Mathis Castell, Rasoarisoa
                 Bayrone</span>
</footer>
	</div>

			
	<?php
		session_start();
		session_unset();
		session_destroy();
	?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>


</html>