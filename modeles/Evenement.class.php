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

    public function setidEvenement($idEvenement)
    {
        TypeException::estNumerique($idEvenement);

        $this->idEvenement = $idEvenement;
    }

    public function setsDateDebut($sDateDebut)
    {
        TypeException::estChaineDeCaracteres($sDateDebut);

        $this->sDateDebut = $sDateDebut;
    }

    public function setsDateFin($sDateFin)
    {
        TypeException::estChaineDeCaracteres($sDateFin);

        $this->sDateFin = $sDateFin;
    }

    public function setsNomEvenement($sNomEvenement)
    {
        TypeException::estChaineDeCaracteres($sNomEvenement);

        $this->sNomEvenement = $sNomEvenement;
    }

    public function setoUtilisateur(Utilisateur $oUtilisateur)
    {
        $this->oUtilisateur = $oUtilisateur;
    }

    /* =============================================================================================== */

    public function getidEvenement()
    {
        return $this->idEvenement;
    }

    public function getsDateDebut()
    {
        return $this->sDateDebut;
    }

    public function getsDateFin()
    {
        return $this->sDateFin;
    }

    public function getsNomEvenement()
    {
        return $this->sNomEvenement;
    }

    public function getoUtilisateur()
    {
        return $this->oUtilisateur;
    }

    /* =============================================================================================== */

    public function __construct($idEvenement = 1, $sDateDebut = "", $sDateFin = "", $sNomEvenement = "", $iNoUtilisateur = 1)
    {
        $this->setidEvenement($idEvenement);
        $this->setsDateDebut($sDateDebut);
        $this->setsDateFin($sDateFin);
        $this->setsNomEvenement($sNomEvenement);
        $this->setoUtilisateur(new Utilisateur($iNoUtilisateur));
    }

    /* =============================================================================================== */


    public function ajouter()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "INSERT evenement
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
                $this->__construct(
                    $aEnregs['idEvenement'],
                    $aEnregs['sDateDebut'],
                    $aEnregs['sDateFin'],
                    $aEnregs['sNomEvenement'],
                    $aEnregs['iNoUtilisateur']
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
                    $aoEnregs[$iEnreg] = new Evenement(
                        $aEnregs[$iEnreg]['idEvenement'],
                        $aEnregs[$iEnreg]['sDateDebut'],
                        $aEnregs[$iEnreg]['sDateFin'],
                        $aEnregs[$iEnreg]['sNomEvenement'],
                        $aEnregs[$iEnreg]['iNoUtilisateur']
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
                    $aoEnregs[$iEnreg] = new Evenement(
                        $aEnregs[$iEnreg]['idEvenement'],
                        $aEnregs[$iEnreg]['sDateDebut'],
                        $aEnregs[$iEnreg]['sDateFin'],
                        $aEnregs[$iEnreg]['sNomEvenement'],
                        $aEnregs[$iEnreg]['iNoUtilisateur']
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
                    $aoEnregs[$iEnreg] = new Evenement(
                        $aEnregs[$iEnreg]['idEvenement'],
                        $aEnregs[$iEnreg]['sDateDebut'],
                        $aEnregs[$iEnreg]['sDateFin'],
                        $aEnregs[$iEnreg]['sNomEvenement'],
                        $aEnregs[$iEnreg]['iNoUtilisateur']
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
