<?php
session_start();

if(isset($_REQUEST['connexionInscription']))
{

    //Connexion
    if(isset($_REQUEST['identifiant']) && isset($_REQUEST['motDePasse']) && !isset($_REQUEST['motDePasse2']) && !isset($_REQUEST['email']) )
    {
        $identifiant = $_REQUEST['identifiant'];
        $motDePasse = sha1($_REQUEST['motDePasse'].GDS);

        $idUtilisateur = Utilisateurs::connexion($identifiant, $motDePasse);

        if($idUtilisateur > 0)
        {
            $_SESSION['utilisateurCourant'] = $idUtilisateur;
            header('Location: index.php?page=profil&user='.$idUtilisateur.'&alert=ConnexionReussie');
        }
        else
        {
            header('Location: index.php?page=connexion&alert=ConnexionEchec');
        }
    }


    if(isset($_REQUEST['identifiant']) && isset($_REQUEST['motDePasse']) && isset($_REQUEST['motDePasse2']) && isset($_REQUEST['email']) )
    {
        $identifiant = $_REQUEST['identifiant'];
        $email = $_REQUEST['email'];
        $motDePasse = sha1($_REQUEST['motDePasse'].GDS);

        if (Utilisateurs::existeEmail($email))
        {
            header('Location: index.php?page=connexion&alert=InscriptionEchecEmail');
        }
        else if (Utilisateurs::existeIdentifiant($identifiant))
        {
            header('Location: index.php?page=connexion&alert=InscriptionEchecIdentifiant');
        }
        else
        {
            $idUtilisateur = Utilisateurs::createUtilisateur($identifiant, $motDePasse, $email);
            header('Location: index.php?page=accueil&alert=InscriptionReussie');
        }
    }
}


