<?php


class Messages 
{

	private $idMessage;

	private $dateMessage;

	private $texteMessage;

	private $idUtilisateur;


		function __construct($idMessage)
		{
			$dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("select * from messages where idMessage = :idMessage;");
			$stmt->bindParam(":idMessage", $idMessage, PDO::PARAM_INT);
			$stmt->execute();
			$message = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$this->idMessage = $idMessage;
			$this->dateMessage = $message['dateMessage'];
			$this->texteMessage = $message['texteMessage'];
			$this->idUtilisateur = $message['idUtilisateur'];
		}



		function __toString()
		{
			return $this->texteMessage;
		}



	    public function getIdMessage()
	    {
	        return $this->idMessage;
	    }


	    public function getDateMessage()
	    {
	        return $this->dateMessage;
	    }

	    public function getTexteMessage()
	    {
	        return $this->texteMessage;
	    }


	    public function getIdUtilisateur()
	    {
	        return $this->idUtilisateur;
	    }

	    private function setIdMessage($idMessage)
	    {
	        $this->idMessage = $idMessage;
	        return $this;
	    }


	    private function setDateMessage($dateMessage)
	    {
	        $this->dateMessage = $dateMessage;
	        return $this;
	    }


	    private function setTexteMessage($texteMessage)
	    {
	        $this->texteMessage = $texteMessage;
	        return $this;
	    }

	    private function setIdUtilisateur($idUtilisateur)
	    {
	        $this->idUtilisateur = $idUtilisateur;
	        return $this;
	    }


	public static function createMessage($texteMessage, $idUtilisateur)
	{

		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("insert into messages (texteMessage, idUtilisateur) values (:texteMessage, :idUtilisateur);");
		
		$stmt->bindParam("texteMessage", utf8_encode($texteMessage), PDO::PARAM_STR);
		$stmt->bindParam("idUtilisateur", $idUtilisateur, PDO::PARAM_INT);

		$stmt->execute();
		$stmt->closeCursor();

		return $dbh->lastInsertId();
	}


	public static function supprimerMessage($idMessage)
	{

		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("delete from messages where idMessage = :idMessage;");
		
		$stmt->bindParam("idMessage", $idMessage, PDO::PARAM_INT);

		$stmt->execute();
		$stmt->closeCursor();
	}



}
