<?php 
class VueCitation
{
       
    /**
    * Afficher la quote
    * @param Utilisateur $oUtilisateur
    * @param string $sMsg
    */
    public function afficherUn(Citation $oCitation, $sMsg = "")
    {
        $sHtml = "
        <div class='container'>
        <blockquote><h3>" . $oCitation->getsCitation() . "</h3></blockquote>
        </div>
        
        ";

    echo $sHtml;
    }

} 