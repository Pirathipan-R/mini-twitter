<?php
	$idConnecte = $_SESSION['utilisateurCourant'];
	$utilisateurConnecte = new Utilisateurs($idConnecte);

	$messagesUtilisateur = $utilisateurConnecte->getAllMessagesVisibles();
	

	include_once "page/accueil.html";