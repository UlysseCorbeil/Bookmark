<?php 
class VueQuote
{
       
    /**
    * Afficher la quote
    * @param Utilisateur $oUtilisateur
    * @param string $sMsg
    */
    public function afficherQuote(Quote $oQuote, $sMsg = "")
    {
        $sHtml = "
        
        <div class='flex-container'>
        <div class='quote-container'>
            <blockquote>
                <h3>" . $oQuote -> getsQuote() . "</h3>
            </blockquote>
        </div>
        
    </div>
    </div>";

    echo $sHtml;
    }

} 