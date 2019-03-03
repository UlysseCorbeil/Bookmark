<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-28
 * Time: 20:39
 */

class Tache
{

    private $idTache;
    private $sTache;
    private $bComplete;
    private $oUtilisateur;

    /* ====================================================================================== */

    /**
     * Set l'id de la tâche
     * @param $idTache
     * @throws TypeException
     */
    public function setidTache($idTache)
    {
        TypeException::estNumerique($idTache);
        $this->idTache = $idTache;
    }

    /**
     * Set de la tâche
     * @param $sTache
     * @throws TypeException
     */
    public function setsTache($sTache)
    {
        TypeException::estChaineDeCaracteres($sTache);
        $this->sTache = $sTache;
    }

    /**
     * Set 0 ou 1 si la tâche est complétée
     * @param $bComplete
     * @throws TypeException
     */
    public function setbComplete($bComplete)
    {
        TypeException::estNumerique($bComplete);
        $this->bComplete = $bComplete;
    }

    /**
     * Set de l'utilisateur
     * @param Utilisateur $oUtilisateur
     */
    public function setoUtilisateur(Utilisateur $oUtilisateur)
    {
        $this->oUtilisateur = $oUtilisateur;
    }

    /* ====================================================================================== */

    /**
     * Get l'id de la tâche
     * @return mixed
     */
    public function getidTache()
    {
        return $this->idTache;
    }

    /**
     * Get la tâche
     * @return mixed
     */
    public function getsTache()
    {
        return $this->sTache;
    }

    /**
     * Get si la tâche est complétée
     * @return mixed
     */
    public function getbComplete()
    {
        return $this->bComplete;
    }

    /**
     * Get l'utilisateur
     * @return mixed
     */
    public function getoUtilisateur()
    {
        return $this->oUtilisateur;
    }

    /* ====================================================================================== */

    /**
     * Tache constructor.
     * @param int $idTache
     * @param string $sTache
     * @param int $bComplete
     * @param int $iNoUtilisateur
     * @throws TypeException
     */
    public function __construct($idTache = 1, $sTache = "", $bComplete = 0, $iNoUtilisateur = 1)
    {
        $this->setidTache($idTache);
        $this->setsTache($sTache);
        $this->setbComplete($bComplete);
        $this->setoUtilisateur(new Utilisateur($iNoUtilisateur));
    }

    /* ====================================================================================== */

    /**
     * Ajouter une tâche dans la BDD
     * @return bool|int
     */
    public function ajouter()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "INSERT INTO tache
			(sTache, bComplete, iNoUtilisateur)
			VALUES(:sTache, :bComplete, :iNoUtilisateur)";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sTache", $this->getsTache(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":bComplete", $this->getbComplete(), PDO::PARAM_STR);
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
     * Modifier une tâche dans la BDD
     * @return bool|int
     */
    public function modifier()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			UPDATE tache
			SET sTache = :sTache, bComplete = :bComplete, iNoUtilisateur = :iNoUtilisateur
			WHERE idTache = :idTache";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sTache", $this->getsTache(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":bComplete", $this->getbComplete(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":iNoUtilisateur", $this->getoUtilisateur()->getidUtilisateur(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":idTache", $this->getidTache(), PDO::PARAM_INT);

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
     * Supprimer une tâche de la BDD
     * @return bool|int
     */
    public function supprimer()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			DELETE FROM tache
			WHERE idTache = :idTache";


        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idTache", $this->getidTache(), PDO::PARAM_INT);

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
     * Rechercher une tâche dans la BDD
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
			FROM tache
			WHERE idTache = :idTache";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idTache", $this->getidTache(), PDO::PARAM_INT);

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
                    $aEnregs['idTache'],
                    $aEnregs['sTache'],
                    $aEnregs['bComplete'],
                    $aEnregs['iNoUtilisateur']
                );

                $oPDOLib->fermerLaConnexion();
                return true;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }


    /**
     * Rechercher toutes tâches dans la BDD
     * @return array|bool
     */
    public function rechercherTous()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM tache";

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
                    $aoEnregs[$iEnreg] = new Tache(
                        $aEnregs[$iEnreg]['idTache'],
                        $aEnregs[$iEnreg]['sTache'],
                        $aEnregs[$iEnreg]['bComplete'],
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

    /**
     * Rechercher toutes tâches d'un utilisateur dans la BDD
     * @return array|bool
     */
    public function rechercherTousParUtilisateur()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM tache WHERE iNoUtilisateur = :iNoUtilisateur";

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
                    $aoEnregs[$iEnreg] = new Tache(
                        $aEnregs[$iEnreg]['idTache'],
                        $aEnregs[$iEnreg]['sTache'],
                        $aEnregs[$iEnreg]['bComplete'],
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
