<?php


class Citation
{
    private $idCitation,
        $sCitation;


    // Set le id du quote
    public function setidCitation($idCitation)
    {
        TypeException::estNumerique($idCitation);
        $this->idCitation = $idCitation;
    }

    // Set la quote
    public function setsCitation($sCitation)
    {
        TypeException::estChaineDeCaracteres($sCitation);
        $this->sCitation = $sCitation;
    }

    // Recupere le ID de la quote
    public function getidCitation()
    {
        return $this->idCitation;
    }

    // Recupere la valeur de la quote
    public function getsCitation()
    {
        return $this->sCitation;
    }

    /**
     * Utilisateur constructor.
     * @param int $idQuote
     * @param string $sNom
     * @throws TypeException
     */
    public function __construct($idCitation = 1, $sCitation = "")
    {
        $this->setidCitation($idCitation);
        $this->setsCitation($sCitation);
    }

    /**
     * Recherche une quote au hasard au chargement de la page
     * @return bool
     * @throws TypeException
     */
    public function chercherRandCitation()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT *
            FROM citation
            ORDER BY RAND()
            LIMIT 1
            ";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs   
        //void

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
            if ($aEnregs !== false) {
                //Affecter les valeurs aux propriétés privées de l'objet
                $this->__construct($aEnregs['idCitation'], $aEnregs['sCitation']);

                $oPDOLib->fermerLaConnexion();
                return true;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    } // fin ()
}
