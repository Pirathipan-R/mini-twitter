<?php

	$idCourant = (isset($_GET['user']) && $_GET['user']!="") ? $_GET['user'] : $_SESSION['utilisateurCourant'];
	$utilisateurCourant = new Utilisateurs($idCourant);

	$idConnecte = $_SESSION['utilisateurCourant'];
	$utilisateurConnecte = new Utilisateurs($idConnecte);

	$messagesUtilisateur = $utilisateurCourant->getAllMessagesFromUser();

	$droitDeVoirLesMessages = Suivre::utilisateurSuivantUtilisateur($utilisateurConnecte->getIdUtilisateur(), $utilisateurCourant->getIdUtilisateur());

	$utilisateursSuivants = Suivre::getUtilisateursSuivant($idCourant);
	$nbUtilisateursSuivant = sizeof($utilisateursSuivants);

	$utilisateursSuivis = Suivre::getUtilisateursSuivi($idCourant);
	$nbUtilisateursSuivi = sizeof($utilisateursSuivis);


	include_once "page/profil.html";

