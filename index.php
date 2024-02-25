<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Swisspharma | Index </title>
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

	
		<div class="jumbotron">
			<h1 class="display-4"> Santé en Évolution</h1>
			<p class="lead"> Swiss Pharma, née de la fusion entre Pharma & Co (spécialisé en maladies virales) et Swiss Labo (axé sur des médicaments conventionnels).</p>
			<p class="lead"> 
				<a class="btn btn-primary btn-lg" href="#" role="button">En savoir plus</a>
			</p>
		</div>
 
		<div id="slides" class="carousel slide" data-ride="carousel">
			
			<ul class="carousel-indicators">
				<li data-target="#slides" data-slide-to="0" class="active"></li>
				<li data-target="#slides" data-slide-to="1"></li>
				<li data-target="#slides" data-slide-to="2"></li>
			</ul>


			
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/exemple.png" style="width:100%;">
				</div>

				<div class="carousel-item">
					<img src="images/exemple.png" style="width:100%;">
				</div>

				<div class="carousel-item">
					<img src="images/exemple.png" style="width:100%;">
				</div>
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-12 mb-3"> <h2 class="text-center"> Actualités </h2> </div>
			<div class="col-sm-12 col-md-4">
				<div class="card mb-4">
					<div class="card-body text-center">
						<h5 class="card-title">Qui sommes nous</h5>
						<p class="cart-text"> Swiss Pharma, résultat de la fusion entre Pharma & Co et Swiss Labo, émerge comme un leader pharmaceutique en 2009, conjuguant expertise dans les maladies virales et médicaments conventionnels. Avec un siège administratif à Paris et social à Philadelphie, elle choisit la France pour optimiser le suivi des activités de visite médicale. Forte de 480 visiteurs médicaux en France métropolitaine et 60 outre-mer, Swiss Pharma se distingue par une restructuration interne et l'engagement envers l'innovation, façonnant ainsi l'avenir de la santé.</p>
						<a href="#" class="card-link">Plus d'infos</a>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-4">
				<div class="card mb-4">
					<div class="	card-body text-center">
						<h5 class="card-title">Titre de l'actu</h5>
						<p class="cart-text"> description de l'actu.</p>
						<a href="#" class="card-link">Plus d'infos</a>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-4">
				<div class="card mb-4">
					<div class="card-body text-center">
						<h5 class="card-title">titre de l'actu</h5>
						<p class="cart-text"> description de l'actu.</p>
						<a href="#" class="card-link">Plus d'infos</a>
					</div>
				</div>
			</div>

		</div>
        
		<footer>
            <div class="card-body text-center bg-primary mt-2 ">
                <span class=" text-light ">Swisspharma, Copyright &copy; SYLLA Oumar, Mathis Castell, Rasoarisoa  Bayrone</span>
            </div>	
		</footer>        
	
    


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>


</html>