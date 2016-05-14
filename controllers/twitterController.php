<?php

session_start();

if(isset($_SESSION['utilisateurCourant']) && !empty($_SESSION['utilisateurCourant']))
{

    if(isset($_REQUEST['idUtilisateurSupprimer']) && $_REQUEST['idUtilisateurSupprimer'] == $_SESSION['utilisateurCourant'])
    {
        Utilisateurs::supprimerUtilisateur($_SESSION['utilisateurCourant']);
        $_SESSION = array();
        session_destroy();
        header('Location: index.php?page=connexion&alert=SuppressionUtilisateur');
    }

    if(isset($_REQUEST['modifierProfil']))
    {
        $utilisateurCourant = new Utilisateurs($_SESSION['utilisateurCourant']);

        if($_REQUEST['numTel'] != $utilisateurCourant->getNumTel())
        {
            $utilisateurCourant->setNumTel($_REQUEST['numTel']);
        }

        if($_REQUEST['email'] != $utilisateurCourant->getEmail())
        {
            $utilisateurCourant->setEmail($_REQUEST['email']);
        }

        if($_REQUEST['dateNaissance'] != $utilisateurCourant->getDateNaissance())
        {
            $utilisateurCourant->setDateNaissance($_REQUEST['dateNaissance']);
        }

        if($_REQUEST['description'] != $utilisateurCourant->getDescription())
        {
            $utilisateurCourant->setDescription($_REQUEST['description']);
        }


        if(!file_exists($_FILES['photoDeProfil']['tmp_name']) || !is_uploaded_file($_FILES['photoDeProfil']['tmp_name']))
        {
            $identifiantUtilisateur = $utilisateurCourant->getIdentifiant();
            $nomDeLaPhoto = $identifiantUtilisateur.".jpg";
            move_uploaded_file($_FILES['photoDeProfil']['tmp_name'], "global/img/utilisateur/$nomDeLaPhoto");
            chmod("global/img/utilisateur/$nomDeLaPhoto", 0666);
            $utilisateurCourant->setPhoto($nomDeLaPhoto);
        }

        header('Location: index.php?page=profil');

    }




    if(isset($_REQUEST['deconnexion']))
    {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php?page=connexion&alert=Deconnexion');
    }

    if(isset($_REQUEST['envoyerMessage']))
    {
        if(isset($_REQUEST['utilisateur'])
            && isset($_REQUEST['messageInput'])
            && !empty($_REQUEST['messageInput'])
            && isset($_REQUEST['pageRedirection']))
        {
            $message = $_REQUEST['messageInput'];
            $message = str_replace(array("\n"), " ", $message);
            $message = str_replace(array("\r"), "", $message);
            $auteur = $_REQUEST['utilisateur'];
            $pageRedirection = $_REQUEST['pageRedirection'];

            if(strlen($message)>140)
            {
                header('Location: index.php?page='.$pageRedirection.'&user='.$auteur.'&alert=MsgEchecLong');
            }
            else
            {
                $idNewMessage = Messages::createMessage($message, $auteur);
                header('Location: index.php?page='.$pageRedirection.'&user='.$auteur.'&alert=MsgReussi');
            }
        }
        else
        {
            header('Location: index.php?page='.$pageRedirection.'&alert=MsgVide');
        }
    }

    if(isset($_REQUEST['idSupprimerMessage']))
    {

        if(isset($_REQUEST['idSupprimerMessage'])
            && isset($_REQUEST['idAuteurMessage'])
            && isset($_REQUEST['pageRedirection'])
            && $_REQUEST['idAuteurMessage'] == $_SESSION['utilisateurCourant'])
        {
            $idMessage = $_REQUEST['idSupprimerMessage'];
            $idUtilisateur = $_REQUEST['idAuteurMessage'];
            $pageRedirection = $_REQUEST['pageRedirection'];
            Messages::supprimerMessage($idMessage);
            header('Location: index.php?page='.$pageRedirection.'&user='.$idUtilisateur.'&alert=MsgSupReussi');

        }
        else
        {
            header('Location: index.php?page=profil&user='.$idUtilisateur.'&alert=MsgSupEchec');
        }
    }

    if(isset($_REQUEST['suivre']))
    {

        if(isset($_REQUEST['utilisateurSuivi'])
            && isset($_REQUEST['utilisateurSuivant']))
        {
            $idUtilisateurSuivant = $_REQUEST['utilisateurSuivant'];
            $idUtilisateurSuivi = $_REQUEST['utilisateurSuivi'];
            Suivre::ajoutUtilisateurSuivantUtilisateur($idUtilisateurSuivant, $idUtilisateurSuivi);
            header('Location: index.php?page=profil&user='.$idUtilisateurSuivi.'&alert=SuiviReussie');
        }
        else
        {
            header('Location: index.php?page=profil&user='.$idUtilisateurSuivi.'&alert=SuiviEchec');
        }
    }

    if(isset($_REQUEST['nePlusSuivre']))
    {
        if(isset($_REQUEST['utilisateurSuivi2'])
            && isset($_REQUEST['utilisateurSuivant2']))
        {
            $idUtilisateurSuivant = $_REQUEST['utilisateurSuivant2'];
            $idUtilisateurSuivi = $_REQUEST['utilisateurSuivi2'];
            Suivre::supprimerUtilisateurSuivantUtilisateur($idUtilisateurSuivant, $idUtilisateurSuivi);
            header('Location: index.php?page=profil&user='.$idUtilisateurSuivi.'&alert=FinSuiviReussi');
        }
        else
        {
            header('Location: index.php?page=profil&user='.$idUtilisateurSuivi.'&alert=FinSuiviEchec');
        }
    }
}