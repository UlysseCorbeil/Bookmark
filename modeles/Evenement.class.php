<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-26
 * Time: 21:18
 */

class Evenement
{

    private $idEvenement;
    private $sDateDebut;
    private $sDateFin;
    private $sNomEvenement;
    private $oUtilisateur;

    /* =============================================================================================== */

    /**
     * Set l'id de l'événement
     * @param $idEvenement
     * @throws TypeException
     */
    public function setidEvenement($idEvenement)
    {
        TypeException::estNumerique($idEvenement);

        $this->idEvenement = $idEvenement;
    }

    /**
     * Set la date de début de l'événement
     * @param $sDateDebut
     * @throws TypeException
     */
    public function setsDateDebut($sDateDebut)
    {
        TypeException::estChaineDeCaracteres($sDateDebut);

        $this->sDateDebut = $sDateDebut;
    }

    /**
     * Set de la date de fin de l'événement
     * @param $sDateFin
     * @throws TypeException
     */
    public function setsDateFin($sDateFin)
    {
        TypeException::estChaineDeCaracteres($sDateFin);

        $this->sDateFin = $sDateFin;
    }


    /**
     * Set le nom de l'événement
     * @param $sNomEvenement
     * @throws TypeException
     */
    public function setsNomEvenement($sNomEvenement)
    {
        TypeException::estChaineDeCaracteres($sNomEvenement);

        $this->sNomEvenement = $sNomEvenement;
    }

    /**
     * Set l'utilisateur
     * @param Utilisateur $oUtilisateur
     */
    public function setoUtilisateur(Utilisateur $oUtilisateur)
    {
        $this->oUtilisateur = $oUtilisateur;
    }

    /* =============================================================================================== */

    /**
     * Get l'id de l'événement
     * @return mixed
     */
    public function getidEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Get la date de début de l'événement
     * @return mixed
     */
    public function getsDateDebut()
    {
        return $this->sDateDebut;
    }

    /**
     * Get la date de fin de l'événement
     * @return mixed
     */
    public function getsDateFin()
    {
        return $this->sDateFin;
    }

    /**
     * Get le nom de l'événement
     * @return mixed
     */
    public function getsNomEvenement()
    {
        return $this->sNomEvenement;
    }

    /**
     * Get l'utilisateur
     * @return mixed
     */
    public function getoUtilisateur()
    {
        return $this->oUtilisateur;
    }

    /* =============================================================================================== */

    /**
     * Evenement constructor.
     * @param int $idEvenement
     * @param string $sDateDebut
     * @param string $sDateFin
     * @param string $sNomEvenement
     * @param int $iNoUtilisateur
     * @throws TypeException
     */
    public function __construct($idEvenement = 1, $sDateDebut = "", $sDateFin = "", $sNomEvenement = "", $iNoUtilisateur = 1)
    {
        $this->setidEvenement($idEvenement);
        $this->setsDateDebut($sDateDebut);
        $this->setsDateFin($sDateFin);
        $this->setsNomEvenement($sNomEvenement);
        $this->setoUtilisateur(new Utilisateur($iNoUtilisateur));
    }

    /* =============================================================================================== */

    /**
     * Ajouter un événement dans la BDD
     * @return bool|int
     */
    public function ajouter()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "INSERT INTO evenement
			(sDateDebut, sDateFin, sNomEvenement, iNoUtilisateur)
			VALUES(:sDateDebut, :sDateFin, :sNomEvenement, :iNoUtilisateur)";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sDateDebut", $this->getsDateDebut(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sDateFin", $this->getsDateFin(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sNomEvenement", $this->getsNomEvenement(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":iNoUtilisateur", $this->getoUtilisateur()->getidUtilisateur(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {

            return (int)$oPDOLib->getoPDO()->lastInsertId();
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

    /**
     * Modifier un événement dans la BDD
     * @return bool|int
     */
    public function modifier()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			UPDATE evenement
			SET sDateDebut= :sDateDebut, sDateFin= :sDateFin, sNomEvenement= :sNomEvenement, iNoUtilisateur= :iNoUtilisateur
			WHERE idEvenement= :idEvenement";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sDateDebut", $this->getsDateDebut(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sDateFin", $this->getsDateFin(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sNomEvenement", $this->getsNomEvenement(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":iNoUtilisateur", $this->getoUtilisateur()->getidUtilisateur(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":idEvenement", $this->getidEvenement(), PDO::PARAM_INT);

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

    /**
     * Supprimer un événement dans la BDD
     * @return bool|int
     */
    public function supprimer()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			DELETE FROM evenement
			WHERE idEvenement= :idEvenement";


        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idEvenement", $this->getidEvenement(), PDO::PARAM_INT);

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

    /**
     * Rechercher un événement dans la BDD
     * @return bool
     * @throws TypeException
     */
    public function rechercherUn()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM evenement
			WHERE idEvenement= :idEvenement";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idEvenement", $this->getidEvenement(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
            if ($aEnregs !== false) {
                //Affecter les valeurs aux propriétés privées de l'objet
                $this->__construct($aEnregs['idEvenement'], $aEnregs['sDateDebut'], $aEnregs['sDateFin'], $aEnregs['sNomEvenement'], $aEnregs['iNoUtilisateur']);

                $oPDOLib->fermerLaConnexion();
                return true;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }


    /**
     * Rechercher tous les événements dans la BDD
     * @return array|bool
     * @throws TypeException
     */
    public function rechercherTous()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * FROM evenement
			";

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
                    $aoEnregs[$iEnreg] = new Evenement($aEnregs[$iEnreg]['idEvenement'], $aEnregs[$iEnreg]['sDateDebut'], $aEnregs[$iEnreg]['sDateFin'], $aEnregs[$iEnreg]['sNomEvenement'], $aEnregs[$iEnreg]['iNoUtilisateur']);
                }
                $oPDOLib->fermerLaConnexion();
                //Retourner le array d'objets de la classe Administrateur
                return $aoEnregs;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    } //fin de la fonction


    /**
     * Rechercher tous les événements d'un utilisateur dans la BDD
     * @return array|bool
     * @throws TypeException
     */
    public function rechercherTousParUtilisateur()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * FROM evenement
            WHERE iNoUtilisateur = :iNoUtilisateur
			";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":iNoUtilisateur", $this->getoUtilisateur()->getidUtilisateur(), PDO::PARAM_INT);

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
                    $aoEnregs[$iEnreg] = new Evenement($aEnregs[$iEnreg]['idEvenement'], $aEnregs[$iEnreg]['sDateDebut'], $aEnregs[$iEnreg]['sDateFin'], $aEnregs[$iEnreg]['sNomEvenement'], $aEnregs[$iEnreg]['iNoUtilisateur']);
                }
                $oPDOLib->fermerLaConnexion();

                //Retourner le array d'objets de la classe Administrateur
                return $aoEnregs;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    } //fin de la fonction


    /**
     * Rechercher tous les événements d'un utilisateur qui se déroulent aujourd'hui en ordre croissant
     * @return array|bool
     * @throws TypeException
     */
    public function rechercherTousAuj()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "SELECT * 
                        FROM evenement 
                        WHERE sDateFin >= CURRENT_TIMESTAMP() AND sDateDebut <= TIMESTAMP(CURRENT_DATE(),
                         '23:59:59') AND iNoUtilisateur = :iNoUtilisateur ORDER BY sDateDebut ASC";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":iNoUtilisateur", $this->getoUtilisateur()->getidUtilisateur(), PDO::PARAM_INT);

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
                    $aoEnregs[$iEnreg] = new Evenement($aEnregs[$iEnreg]['idEvenement'], $aEnregs[$iEnreg]['sDateDebut'], $aEnregs[$iEnreg]['sDateFin'], $aEnregs[$iEnreg]['sNomEvenement'], $aEnregs[$iEnreg]['iNoUtilisateur']);
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
