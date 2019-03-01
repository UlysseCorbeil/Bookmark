<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-26
 * Time: 20:40
 */

class Utilisateur
{

    private $idUtilisateur;
    private $sNom;
    private $sPrenom;
    private $sCourriel;
    private $sPseudo;
    private $sMotDePasse;
    private $sAvatar;
    private $sDateInscription;

    /* =============================================================================================== */

    public function setidUtilisateur($idUtilisateur)
    {
        TypeException::estNumerique($idUtilisateur);

        $this->idUtilisateur = $idUtilisateur;
    }

    public function setsNom($sNom)
    {
        TypeException::estChaineDeCaracteres($sNom);

        $this->sNom = $sNom;
    }

    public function setsPrenom($sPrenom)
    {
        TypeException::estChaineDeCaracteres($sPrenom);

        $this->sPrenom = $sPrenom;
    }

    public function setsCourriel($sCourriel)
    {
        TypeException::estChaineDeCaracteres($sCourriel);

        $this->sCourriel = $sCourriel;
    }

    public function setsPseudo($sPseudo)
    {
        TypeException::estChaineDeCaracteres($sPseudo);

        $this->sPseudo = $sPseudo;
    }

    public function setsMotDePasse($sMotDePasse)
    {
        TypeException::estChaineDeCaracteres($sMotDePasse);

        $this->sMotDePasse = $sMotDePasse;
    }

    public function setsAvatar($sAvatar)
    {
        TypeException::estChaineDeCaracteres($sAvatar);

        $this->sAvatar = $sAvatar;
    }

    public function setsDateInscription($sDateInscription)
    {
        TypeException::estChaineDeCaracteres($sDateInscription);

        $this->sDateInscription = $sDateInscription;
    }

    /* =============================================================================================== */

    public function getidUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getsNom()
    {
        return $this->sNom;
    }

    public function getsPrenom()
    {
        return $this->sPrenom;
    }

    public function getsCourriel()
    {
        return $this->sCourriel;
    }

    public function getsPseudo()
    {
        return $this->sPseudo;
    }

    public function getsMotDePasse()
    {
        return $this->sMotDePasse;
    }

    public function getsAvatar()
    {
        return $this->sAvatar;
    }

    public function getsDateInscription()
    {
        return $this->sDateInscription;
    }

    /* =============================================================================================== */

    public function __construct($idUtilisateur = 1, $sNom = "", $sPrenom = "", $sCourriel = "", $sPseudo = "", $sMotDePasse = "", $sAvatar = "", $sDateInscription = "")
    {
        $this->setidUtilisateur($idUtilisateur);
        $this->setsNom($sNom);
        $this->setsPrenom($sPrenom);
        $this->setsCourriel($sCourriel);
        $this->setsPseudo($sPseudo);
        $this->setsMotDePasse($sMotDePasse);
        $this->setsAvatar($sAvatar);
        $this->setsDateInscription($sDateInscription);
    }

    /* =============================================================================================== */


    public function ajouter()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "INSERT utilisateur
			(sNom, sPrenom, sCourriel, sPseudo, sMotDePasse, sAvatar, sDateInscription)
			VALUES(:sNom, :sPrenom, :sCourriel, :sPseudo, :sMotDePasse, :sAvatar, :sDateInscription)";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sNom", $this->getsNom(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sPrenom", $this->getsPrenom(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sCourriel", $this->getsCourriel(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sPseudo", $this->getsPseudo(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sMotDePasse", $this->getsMotDePasse(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sAvatar", $this->getsAvatar(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sDateInscription", date("Y-m-d H:i:s"), PDO::PARAM_STR);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {

            return (int)$oPDOLib->getoPDO()->lastInsertId();
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

    public function modifier()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			UPDATE utilisateur
			SET sNom= :sNom, sPrenom= :sPrenom, sCourriel= :sCourriel, sPseudo= :sPseudo, sMotDePasse= :sMotDePasse, sAvatar= :sAvatar
			WHERE idUtilisateur= :idUtilisateur";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sNom", $this->getsNom(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sPrenom", $this->getsPrenom(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sCourriel", $this->getsCourriel(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sPseudo", $this->getsPseudo(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sMotDePasse", $this->getsMotDePasse(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sAvatar", $this->getsAvatar(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":idUtilisateur", $this->getidUtilisateur(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            $oPDOLib->fermerLaConnexion();
            return (int)$oPDOStatement->rowCount();
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

    public function supprimer()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			DELETE FROM utilisateur
			WHERE idUtilisateur= :idUtilisateur";


        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idUtilisateur", $this->getidUtilisateur(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            $oPDOLib->fermerLaConnexion();
            return (int)$oPDOStatement->rowCount();
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

    public function rechercherUn()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM utilisateur
			WHERE idUtilisateur= :idUtilisateur";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idUtilisateur", $this->getidUtilisateur(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //var_dump($oPDOStatement->errorInfo());

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
            if ($aEnregs !== false) {
                //Affecter les valeurs aux propriétés privées de l'objet
                $this->__construct(
                    $aEnregs['idUtilisateur'],
                    $aEnregs['sNom'],
                    $aEnregs['sPrenom'],
                    $aEnregs['sCourriel'],
                    $aEnregs['sPseudo'],
                    "",
                    $aEnregs['sAvatar'],
                    $aEnregs['sDateInscription']
                );

                $oPDOLib->fermerLaConnexion();
                return true;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }


    public function rechercherTous()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM utilisateur";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        //void

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer le array
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            $iMax = count($aEnregs);
            $aoEnregs = array();
            if ($iMax > 0) {
                for ($iEnreg = 0; $iEnreg < $iMax; $iEnreg++) {
                    $aoEnregs[$iEnreg] = new Utilisateur(
                        $aEnregs[$iEnreg]['idUtilisateur'],
                        $aEnregs[$iEnreg]['sNom'],
                        $aEnregs[$iEnreg]['sPrenom'],
                        $aEnregs[$iEnreg]['sCourriel'],
                        $aEnregs[$iEnreg]['sPseudo'],
                        "",
                        $aEnregs[$iEnreg]['sAvatar'],
                        $aEnregs[$iEnreg]['sDateInscription']
                    );
                }
                $oPDOLib->fermerLaConnexion();
                //Retourner le array d'objets de la classe Administrateur
                return $aoEnregs;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    } //fin de la fonction
}
