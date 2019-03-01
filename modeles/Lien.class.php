<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-28
 * Time: 19:52
 */

class Lien {

    private $idLiens;
    private $sUrl;
    private $sFavicon;
    private $sNomSite;

    /* ====================================================================================== */

    /**
     * Set l'id du lien
     * @param $idLiens
     * @throws TypeException
     */
    public function setidLiens($idLiens) {
        TypeException::estNumerique($idLiens);
        $this->idLiens = $idLiens;
    }

    /**
     * Set l'url du lien
     * @param $sUrl
     * @throws TypeException
     */
    public function setsUrl($sUrl) {
        TypeException::estChaineDeCaracteres($sUrl);
        $this->sUrl = $sUrl;
    }

    /**
     * Set le favicon du lien
     * @param $sFavicon
     * @throws TypeException
     */
    public function setsFavicon($sFavicon) {
        TypeException::estChaineDeCaracteres($sFavicon);
        $this->sFavicon = $sFavicon;
    }

    /**
     * Set le nom du site
     * @param $sNomSite
     * @throws TypeException
     */
    public function setsNomSite($sNomSite) {
        TypeException::estChaineDeCaracteres($sNomSite);
        $this->sNomSite = $sNomSite;
    }

    /* ====================================================================================== */

    /**
     * Get l'id du lien
     * @return mixed
     */
    public function getidLiens() {
        return $this->idLiens;
    }

    /**
     * Get l'URL du lien
     * @return mixed
     */
    public function getsUrl() {
        return $this->sUrl;
    }

    /**
     * Get le favicon du lien
     * @return mixed
     */
    public function getsFavicon() {
        return $this->sFavicon;
    }

    /**
     * Get le nom du site
     * @return mixed
     */
    public function getsNomSite() {
        return $this->sNomSite;
    }

    /* ====================================================================================== */

    /**
     * Liens constructor.
     * @param int $idLiens
     * @param string $sUrl
     * @param string $sFavicon
     * @param string $sNomSite
     * @throws TypeException
     */
    public function __construct($idLiens = 1, $sUrl = "", $sFavicon = "", $sNomSite = "") {
        $this->setidLiens($idLiens);
        $this->setsUrl($sUrl);
        $this->setsFavicon($sFavicon);
        $this->setsNomSite($sNomSite);
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
        $sRequete = "INSERT INTO lien
			(sUrl, sFavicon, sNomSite)
			VALUES(:sUrl, :sFavicon, :sNomSite)";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sUrl", $this->getsUrl(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sFavicon", $this->getsFavicon(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sNomSite", $this->getsNomSite(), PDO::PARAM_STR);

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
			UPDATE lien
			SET sUrl = :sUrl, sFavicon = :sFavicon, sNomSite = :sNomSite
			WHERE idLien = :idLien";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sUrl", $this->getsUrl(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sFavicon", $this->getsFavicon(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sNomSite", $this->getsNomSite(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":idLien", $this->getidLiens(), PDO::PARAM_INT);

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
			DELETE FROM lien
			WHERE idLien = :idLien";


        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idLien", $this->getidLiens(), PDO::PARAM_INT);

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
			FROM lien
			WHERE idLien = :idLien";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idLien", $this->getidLiens(), PDO::PARAM_INT);

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
                    $aEnregs['idLien'],
                    $aEnregs['sUrl'],
                    $aEnregs['sFavicon'],
                    $aEnregs['sNomSite']
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
			FROM liens";

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
                    $aoEnregs[$iEnreg] = new Utilisateur(
                        $aEnregs[$iEnreg]['idLien'],
                        $aEnregs[$iEnreg]['sUrl'],
                        $aEnregs[$iEnreg]['sFavicon'],
                        $aEnregs[$iEnreg]['sNomSite']
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
