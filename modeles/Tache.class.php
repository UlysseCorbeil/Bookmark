<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-28
 * Time: 20:39
 */

class Tache {

    private $idTache;
    private $sTache;
    private $bComplete;
    private $oUtilisateur;

    /* ====================================================================================== */

    public function setidTache($idTache){
        TypeException::estNumerique($idTache);
        $this->idTache = $idTache;
    }

    public function setsTache($sTache){
        TypeException::estChaineDeCaracteres($sTache);
        $this->sTache = $sTache;
    }

    public function setbComplete($bComplete){
        TypeException::estNumerique($bComplete);
        $this->bComplete = $bComplete;
    }

    public function setoUtilisateur(Utilisateur $oUtilisateur){
        $this->oUtilisateur = $oUtilisateur;
    }

    /* ====================================================================================== */

    public function getidTache(){
        return $this->idTache;
    }

    public function getsTache(){
        return $this->sTache;
    }

    public function getbComplete(){
        return $this->bComplete;
    }

    public function getoUtilisateur(){
        return $this->oUtilisateur;
    }

    /* ====================================================================================== */

    public function __construct($idTache=1, $sTache="", $bComplete=0, $iNoUtilisateur=1) {
        $this->setidTache($idTache);
        $this->setsTache($sTache);
        $this->setbComplete($bComplete);
        $this->setoUtilisateur(new Utilisateur($iNoUtilisateur));
    }

    /* ====================================================================================== */

    /**
     * Ajouter un lien dans la BDD
     * @return bool|int
     */
    public function ajouter(){
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
        if($b == true){
            return (int)$oPDOLib->getoPDO()->lastInsertId();
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }

    /**
     * Modifier un lien dans la BDD
     * @return bool|int
     */
    public function modifier(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
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
        if($b == true){
            $oPDOLib->fermerLaConnexion();
            return (int)$oPDOStatement->rowCount();
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }

    /**
     * Supprimer un lien de la BDD
     * @return bool|int
     */
    public function supprimer(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			DELETE FROM tache
			WHERE idTache = :idTache";


        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idTache", $this->getidTache(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if($b == true){
            $oPDOLib->fermerLaConnexion();
            return (int)$oPDOStatement->rowCount();
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }

    /**
     * Rechercher un lien dans la BDD
     * @return bool
     * @throws TypeException
     */
    public function rechercherUn(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
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
        if($b == true){
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
            if($aEnregs !== false){
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
     * Rechercher tous les liens dans la BDD
     * @return array|bool
     */
    public function rechercherTous(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT * 
			FROM tache";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        //void

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if($b == true){
            //Récupérer le array
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            $iMax = count($aEnregs);
            $aoEnregs = array();
            if($iMax > 0){
                for($iEnreg=0;$iEnreg<$iMax;$iEnreg++){
                    $aoEnregs[$iEnreg] = new Tache(
                        $aEnregs['idTache'],
                        $aEnregs['sTache'],
                        $aEnregs['bComplete'],
                        $aEnregs['iNoUtilisateur']
                    );
                }
                $oPDOLib->fermerLaConnexion();
                //Retourner le array d'objets de la classe Administrateur
                return $aoEnregs;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }//fin de la fonction

}
