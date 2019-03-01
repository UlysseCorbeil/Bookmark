<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-28
 * Time: 20:58
 */

class RelUtilisateurLien {

    private $idRelUtilLiens;
    private $oUtilisateur;
    private $oLien;
    private $iPosLien; // Plus le chiffre est élevé, plus il est important

    /* ====================================================================================== */

    /**
     * Set l'id de la relation entre l'utilisateur et le lien
     * @param $idRelUtilLiens
     * @throws TypeException
     */
    public function setidRelUtilLiens($idRelUtilLiens) {
        TypeException::estNumerique($idRelUtilLiens);
        $this->idRelUtilLiens = $idRelUtilLiens;
    }

    /**
     * Set l'utilisateur
     * @param Utilisateur $oUtilisateur
     */
    public function setoUtilisateur(Utilisateur $oUtilisateur) {
        $this->oUtilisateur = $oUtilisateur;
    }

    /**
     * Set le lien
     * @param Lien $oLien
     */
    public function setoLien(Lien $oLien) {
        $this->oLien = $oLien;
    }

    /**
     * Set la position du lien
     * @param $iPosLien
     * @throws TypeException
     */
    public function setiPosLien($iPosLien) {
        TypeException::estNumerique($iPosLien);
        $this->iPosLien = $iPosLien;
    }

    /* ====================================================================================== */

    /**
     * Get l'id de la relation entre l'utilisateur et le lien
     * @return mixed
     */
    public function getidRelUtilLiens() {
        return $this->idRelUtilLiens;
    }

    /**
     * Get l'utilisateur
     * @return mixed
     */
    public function getoUtilisateur() {
        return $this->oUtilisateur;
    }

    /**
     * Get le lien
     * @return mixed
     */
    public function getoLien() {
        return $this->oLien;
    }

    /**
     * Get la position du lien
     * @return mixed
     */
    public function getiPosLien() {
        return $this->iPosLien;
    }

    /* ====================================================================================== */

    /**
     * RelUtilisateurLien constructor.
     * @param int $idRelUtilLiens
     * @param int $iNoUtilisateur
     * @param int $iNoLien
     * @param int $iPosLien
     * @throws TypeException
     */
    public function __construct($idRelUtilLiens = 1, $iNoUtilisateur = 1, $iNoLien = 1, $iPosLien = 0) {
        $this->setidRelUtilLiens($idRelUtilLiens);
        $this->setoUtilisateur(new Utilisateur($iNoUtilisateur));
        $this->setoLien(new Lien($iNoLien));
        $this->setiPosLien($iPosLien);
    }

    /* ====================================================================================== */

    /**
     * Ajouter une relation entre l'utilisateur et le lien dans la BDD
     * @return bool|int
     */
    public function ajouter(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "INSERT INTO rel_utilisateur_lien
			(iNoUtilisateur, iNoLiens, iPosLien)
			VALUES(:iNoUtilisateur, :iNoLiens, :iPosLien)";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":iNoUtilisateur", $this->getoUtilisateur()->getidUtilisateur(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":iNoLiens", $this->getoLien()->getidLien(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":iPosLien", $this->getiPosLien(), PDO::PARAM_INT);

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
     * Modifier une relation entre l'utilisateur et le lien dans la BDD
     * @return bool|int
     */
    public function modifier(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			UPDATE rel_utilisateur_lien
			SET iNoUtilisateur = :iNoUtilisateur, iNoLiens = :iNoLiens, iPosLien = :iPosLien
			WHERE idRelUtilLiens = :idRelUtilLiens";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":iNoUtilisateur", $this->getoUtilisateur()->getidUtilisateur(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":iNoLiens", $this->getoLien()->getidLien(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":iPosLien", $this->getiPosLien(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":idRelUtilLiens", $this->getidRelUtilLiens(), PDO::PARAM_INT);

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
     * Supprimer une relation entre l'utilisateur et le lien de la BDD
     * @return bool|int
     */
    public function supprimer(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			DELETE FROM rel_utilisateur_lien
			WHERE idRelUtilLiens = :idRelUtilLiens";


        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idRelUtilLiens", $this->getidRelUtilLiens(), PDO::PARAM_INT);

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
     * Rechercher une relation entre l'utilisateur et le lien dans la BDD
     * @return bool
     * @throws TypeException
     */
    public function rechercherUn(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT * 
			FROM rel_utilisateur_lien
			WHERE idRelUtilLiens = :idRelUtilLiens";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idRelUtilLiens", $this->getidRelUtilLiens(), PDO::PARAM_INT);

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
                    $aEnregs['idRelUtilLiens'],
                    $aEnregs['iNoUtilisateur'],
                    $aEnregs['iNoLiens'],
                    $aEnregs['iPosLien']
                );

                $oPDOLib->fermerLaConnexion();
                return true;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }


    /**
     * Rechercher toutes relations entre l'utilisateur et le lien dans la BDD
     * @return array|bool
     */
    public function rechercherTous(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT * 
			FROM rel_utilisateur_lien";

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
                    $aoEnregs[$iEnreg] = new RelUtilisateurLien(
                        $aEnregs[$iEnreg]['idRelUtilLiens'],
                        $aEnregs[$iEnreg]['iNoUtilisateur'],
                        $aEnregs[$iEnreg]['iNoLiens'],
                        $aEnregs[$iEnreg]['iPosLien']
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


    /**
     * Rechercher tous les liens en fonction de l'utilisateur
     * @return array|bool
     * @throws TypeException
     */
    public function rechercherTousLiensParUtilisateur(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT * 
			FROM rel_utilisateur_lien
			LEFT JOIN lien ON idLiens = iNoLiens
			WHERE iNoUtilisateur = :iNoUtilisateur ORDER BY iPosLien DESC";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":iNoUtilisateur", $this->getoUtilisateur()->getidUtilisateur(), PDO::PARAM_INT);

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

                    $aoEnregs[$iEnreg] = new RelUtilisateurLien(
                        $aEnregs[$iEnreg]['idRelUtilLiens'],
                        $aEnregs[$iEnreg]['iNoUtilisateur'],
                        $aEnregs[$iEnreg]['iNoLiens'],
                        $aEnregs[$iEnreg]['iPosLien']
                    );
                    $aoEnregs[$iEnreg]->setoLien(new Lien(
                        $aEnregs[$iEnreg]['idLiens'],
                        $aEnregs[$iEnreg]['sUrl'],
                        $aEnregs[$iEnreg]['sFavicon'],
                        $aEnregs[$iEnreg]['sNomSite']
                    ));
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
