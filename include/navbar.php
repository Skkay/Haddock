<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/Haddock">
            <img src="/Haddock/assets/ressources/images/logo2.png" width="25%" height="25%" class="d-inline-block" alt="">
            <span class="">LesMotsTordus</span>
        </a>
        <form><input class="btn btn-outline-primary" type="button" value="Accueil" onclick="window.location.href='/Haddock/'" /></form>
    </div>
</nav>

<?php if (isset($_SESSION["id"]) AND isset($_SESSION["identifiant"])) { ?>
<nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
	<div class="container">
		<ul class="navbar-nav">
			<span class="navbar-brand mb-0 h1">Administration :</span>
			<li class="nav-item active">
				<a class="nav-link" href="/Haddock/administration/home.php">Accueil</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="/Haddock/administration/profil/">Gestion de compte</a>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="nav-item active">
				<a class="nav-link" href="/Haddock/administration/deconnexion.php">Deconnexion</a>
			</li>
		</ul>

	</div>
</nav>
<?php } ?>
