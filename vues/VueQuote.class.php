<?php 
class VueQuote
{
       
    /**
    * Afficher la quote
    * @param Utilisateur $oUtilisateur
    * @param string $sMsg
    */
    public function afficherUn(Quote $oQuote, $sMsg = "")
    {
        $sHtml = "
            <div id='citation'>
                <span>&#34;</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam blanditiis, commodi dicta ducimus
                    facilis minus nemo officia perferendis praesentium rerum sapiente sequi similique, tempore ullam vel
                    vitae voluptatibus. Assumenda, pariatur!</p>
                <span>&#34;</span>
            </div>
        ";

    echo $sHtml;
    }

} 