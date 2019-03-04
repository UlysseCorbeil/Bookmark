<?php


class Quote
{
    private $idQuote,
        $sQuote;


    // Set le id du quote
    public function setidQuote($idQuote)
    {
        TypeException::estNumerique($idQuote);
        $this->idQuote = $idQuote;
    }

    // Set la quote
    public function setsQuote($sQuote)
    {
        TypeException::estChaineDeCaracteres($sQuote);
        $this->sQuote = $sQuote;
    }

    // Recupere le ID de la quote
    public function getidQuote()
    {
        return $this->idQuote;
    }

    // Recupere la valeur de la quote
    public function getsQuote()
    {
        return $this->sQuote;
    }

    /**
     * Utilisateur constructor.
     * @param int $idQuote
     * @param string $sNom
     * @throws TypeException
     */
    public function __construct($idQuote = 1, $sQuote = "")
    {
        $this->setidQuote($idQuote);
        $this->setsQuote($sQuote);
    }

    /**
     * Recherche une quote au hasard au chargement de la page
     * @return bool
     * @throws TypeException
     */
    public function chercherRandQuote()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT *
            FROM quotes
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
                $this->__construct($aEnregs['idQuote'], $aEnregs['sQuote']);

                $oPDOLib->fermerLaConnexion();
                return true;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    } // fin ()
}
