<?php

abstract class Suivre 
{
	private $idUtilisateurSuivi;
	private $idUtilisateurSuivant;



	public static function getUtilisateursSuivant($idUtilisateurSuivi)
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idUtilisateurSuivant from suivre where idUtilisateurSuivi = :idUtilisateurSuivi;");
		$stmt->bindParam(":idUtilisateurSuivi", $idUtilisateurSuivi, PDO::PARAM_INT);
		$stmt->execute();
		$utilisateursSuivant = array();
		while( $utilisateurSuivant = $stmt->fetch(PDO::FETCH_NUM) )
		{
			$utilisateursSuivant[] = $utilisateurSuivant[0]; 
		}
		$stmt->closeCursor();
		return $utilisateursSuivant;
	}


	public static function getUtilisateursSuivi($idUtilisateurSuivant)
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idUtilisateurSuivi from suivre where idUtilisateurSuivant = :idUtilisateurSuivant;");
		$stmt->bindParam(":idUtilisateurSuivant", $idUtilisateurSuivant, PDO::PARAM_INT);
		$stmt->execute();
		$utilisateursSuivi = array();
		while( $utilisateurSuivi = $stmt->fetch(PDO::FETCH_NUM) )
		{
			$utilisateursSuivi[] = $utilisateurSuivi[0]; 
		}
		$stmt->closeCursor();
		return $utilisateursSuivi;
	}

	public static function utilisateurSuivantUtilisateur($utilisateurSuivant, $utilisateurSuivi)
	{

		if($utilisateurSuivant == $utilisateurSuivi)
		{
			return true;
		}
		else
		{
			$dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("select * from suivre where idUtilisateurSuivant = :utilisateurSuivant and idUtilisateurSuivi = :utilisateurSuivi;");
			$stmt->bindParam(":utilisateurSuivant", $utilisateurSuivant, PDO::PARAM_INT);
			$stmt->bindParam(":utilisateurSuivi", $utilisateurSuivi, PDO::PARAM_INT);
			$stmt->execute();
			$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();

			return empty($resultat) ? false : true;
		}
	}

	public function ajoutUtilisateurSuivantUtilisateur($utilisateurSuivant, $utilisateurSuivi)
	{
		if($utilisateurSuivant != $utilisateurSuivi && Suivre::utilisateurSuivantUtilisateur($utilisateurSuivant, $utilisateurSuivi) == false)
		{
			$dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("insert into suivre(idUtilisateurSuivant, idUtilisateurSuivi) values (:utilisateurSuivant, :utilisateurSuivi);");
			$stmt->bindParam(":utilisateurSuivant", $utilisateurSuivant, PDO::PARAM_INT);
			$stmt->bindParam(":utilisateurSuivi", $utilisateurSuivi, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		}
		else
		{
			return false;
		}
	}

	public function supprimerUtilisateurSuivantUtilisateur($utilisateurSuivant, $utilisateurSuivi)
	{
		if($utilisateurSuivant != $utilisateurSuivi && Suivre::utilisateurSuivantUtilisateur($utilisateurSuivant, $utilisateurSuivi) == true)
		{
			$dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("delete from suivre where idUtilisateurSuivant = :utilisateurSuivant and idUtilisateurSuivi = :utilisateurSuivi;");
			$stmt->bindParam(":utilisateurSuivant", $utilisateurSuivant, PDO::PARAM_INT);
			$stmt->bindParam(":utilisateurSuivi", $utilisateurSuivi, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
			return  true;
		}
		else
		{
			return false;
		}
	}
}