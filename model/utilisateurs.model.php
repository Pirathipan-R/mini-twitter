<?php

class Utilisateurs 
{

	private $idUtilisateur;
	private $identifiant;
	private $motDePasse;
	private $email;
	private $numTel;
	private $description;
	private $photo;
	private $dateNaissance;

		function __construct($idUtilisateur)
		{
			$dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("select * from utilisateurs where idUtilisateur = :idUtilisateur;");
			$stmt->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();
			$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$this->idUtilisateur = $idUtilisateur;
			$this->identifiant = $utilisateur['identifiantUtilisateur'];
			$this->motDePasse = $utilisateur['motDePasseUtilisateur'];
			$this->email = $utilisateur['emailUtilisateur'];
			$this->numTel = $utilisateur['numTelUtilisateur'];
			$this->description = $utilisateur['descriptionUtilisateur'];
			$this->photo = $utilisateur['photoUtilisateur'];
			$this->dateNaissance = $utilisateur['dateNaissanceUtilisateur'];
		}

		function __toString()
		{
			return "".$this->identifiant;
		}


	    public function getIdUtilisateur()
	    {
	        return $this->idUtilisateur;
	    }

	    public function getIdentifiant()
	    {
	        return $this->identifiant;
	    }


	    public function getEmail()
	    {
	        return $this->email;
	    }

	    public function getNumTel()
	    {
	        return $this->numTel;
	    }

	    public function getDescription()
	    {
	        return $this->description;
	    }

	    public function getPhoto()
	    {
	        return $this->photo;
	    }

	    public function getDateNaissance()
	    {
	        return $this->dateNaissance;
	    }



	    public function setIdentifiant($identifiant)
	    {
	        $this->identifiant = $identifiant;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set identifiantUtilisateur = :identifiant  where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("identifiant", $identifiant, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }


	    public function setMotDePasse($motDePasse)
	    {
	        $this->motDePasse = sha1($motDePasse.GDS);
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set motDePasseUtilisateur = :motDePasse where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("motDePasse", $motDePasse, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }


	    public function setEmail($email)
	    {
	        $this->email = $email;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set emailUtilisateur = :emailUtilisateur where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("emailUtilisateur", $email, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }

	    public function setNumTel($numTel=null)
	    {
	        $this->numTel = $numTel;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set numTelUtilisateur = :numTelUtilisateur where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("numTelUtilisateur", $numTel, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);

			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }

	    public function setDescription($description=null)
	    {
	        $this->description = $description;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set descriptionUtilisateur = :descriptionUtilisateur where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("descriptionUtilisateur", $description, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }


	    public function setPhoto($photo)
	    {
	        $this->photo = $photo;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set photoUtilisateur = :photoUtilisateur  where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("photoUtilisateur", $photo, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }


	    public function setDateNaissance($dateNaissance=null)
	    {
	        $this->dateNaissance = $dateNaissance;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set dateNaissanceUtilisateur = :dateNaissanceUtilisateur where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("dateNaissanceUtilisateur", $dateNaissance, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }


	public static function createUtilisateur($identifiant, $motDePasse, $email, $numTel=null, $description=null, $photo="default.png", $dateNaissance=null)
	{
		// Vérification de l'email et du numéro de téléphone et sha1 du motdepasse?
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("insert into utilisateurs (identifiantUtilisateur, motDePasseUtilisateur, emailUtilisateur, numTelUtilisateur, descriptionUtilisateur, photoUtilisateur, dateNaissanceUtilisateur) values (:identifiant, :motDePasse, :email, :numTel, :description, :photo, :dateNaissance);");
		
		$stmt->bindParam("identifiant", $identifiant, PDO::PARAM_STR);
		$stmt->bindParam("motDePasse", $motDePasse, PDO::PARAM_STR);
		$stmt->bindParam("email", $email, PDO::PARAM_STR);
		$stmt->bindParam("numTel", $numTel, PDO::PARAM_STR);
		$stmt->bindParam("description", $description, PDO::PARAM_STR);
		$stmt->bindParam("photo", $photo, PDO::PARAM_STR);
		$stmt->bindParam("dateNaissance", $dateNaissance, PDO::PARAM_STR);

		$stmt->execute();
		$stmt->closeCursor();
		// A vérifier, dernière id inséré = id de l'utilisateur créé
		return $dbh->lastInsertId();
	}


	public static function supprimerUtilisateur($idUtilisateur)
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("delete from utilisateurs where idUtilisateur = :idUtilisateur");
		
		$stmt->bindParam("idUtilisateur", $idUtilisateur, PDO::PARAM_INT);

		$stmt->execute();
		$stmt->closeCursor();
	}

	public static function connexion($identifiant, $motDePasse)
	{	
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idUtilisateur from utilisateurs where identifiantUtilisateur = :identifiant and motDePasseUtilisateur = :motDePasse");
		
		$stmt->bindParam("identifiant", $identifiant, PDO::PARAM_STR);
		$stmt->bindParam("motDePasse", $motDePasse, PDO::PARAM_STR);
		$stmt->execute();

		$utilisateur = $stmt->fetch();
		$stmt->closeCursor();

		if(!empty($utilisateur))
		{
			// retourne l'identifiant de l'utilisateur connecté avec cet identifiant et ce mot de passe
			$idUtilisateur = $utilisateur['idUtilisateur'];
		} else {
			// retourne 0 si il n'y a pas d'utilisateur avec cet identifiant et ce mot de passe
			$idUtilisateur = 0;
		}
		return $idUtilisateur;
	}


	public static function existeEmail($email)
	{	
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select * from utilisateurs where emailUtilisateur = :email");
		
		$stmt->bindParam("email", $email, PDO::PARAM_STR);
		$stmt->execute();

		$number = $stmt->fetch();
		$stmt->closeCursor();

		return !empty($number);
	}


	public static function existeIdentifiant($identifiant)
	{	
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select * from utilisateurs where identifiantUtilisateur = :identifiant");
		
		$stmt->bindParam("identifiant", $identifiant, PDO::PARAM_STR);
		$stmt->execute();

		$number = $stmt->fetch();
		$stmt->closeCursor();

		return !empty($number);
	}


	public function getAllMessagesFromUser()
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idMessage from messages where idUtilisateur = :idUtilisateur order by dateMessage desc");
		
		$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_STR);
		$stmt->execute();

		$messages = array();

		$resultat = $stmt->fetchAll();
		foreach ($resultat as $row) {
		    array_push($messages, new Messages($row['idMessage']));
		}
		$stmt->closeCursor();

		return $messages;
	}

	public function getAllMessagesVisibles()
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idMessage, dateMessage from messages where idUtilisateur = :idUtilisateur or idUtilisateur in (select idUtilisateurSuivi from suivre where idUtilisateurSuivant = :idUtilisateur) order by dateMessage desc");
		
		$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_STR);
		$stmt->execute();

		$messages = array();

		$resultat = $stmt -> fetchAll();
		foreach ($resultat as $row) {
		    array_push($messages, new Messages($row['idMessage']));
		}
		$stmt->closeCursor();

		return $messages;
	}


	public static function getAllUtilisateurs()
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idUtilisateur from utilisateurs order by identifiantUtilisateur");
		
		$stmt->execute();

		$utilisateurs = $stmt -> fetchAll(PDO::FETCH_ASSOC);

		$stmt->closeCursor();

		return $utilisateurs;
	}


}