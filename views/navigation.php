<?php
	$idConnecte = $_SESSION['utilisateurCourant'];
	$utilisateurConnecte = new Utilisateurs($idConnecte);
	$idCourant = $_GET['user'];
	$listeUtilisateurs = Utilisateurs::getAllUtilisateurs();


	include_once "page/navigation.html";

	include_once "page/modalModifierProfil.html";

	include_once "page/modalEcrireMessage.html";
