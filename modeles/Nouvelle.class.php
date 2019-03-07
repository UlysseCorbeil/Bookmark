<?php 

// Classe où l'on retire les dernières nouvelles 
class Nouvelle
{
    // Permet de get l'information à partir du URL donné 
    // @return XML
    public function getNouvelles()
    {

        // Fichier XML avec l'information
        $xml = ("https://www.ledevoir.com/rss/manchettes.xml");

        // div conteneur
        $sHtml = "
        <div id='nouvelles'>
            <h2>Nouvelles</h2>
            <div id='news-container' class='div-content'>
            <div class='item news-item'>
        ";

        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);

        //GET elements dans le channel
        $channel = $xmlDoc->getElementsByTagName('channel')->item(0);
        $channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
        $channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;

        // Get le titre du journal
        $titreJournal = substr($channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue, 13);

        // Prend et affiche les éléments items, le titre et le lien vers l'article. (TEST)
        $x = $xmlDoc->getElementsByTagName('item');

        // changer la valeur de i pour augmenter le nombres de nouvelles (4 articles sont retournés pour l'instant)
        for ($i = 0; $i <= 21; $i++) {

            $item_title = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
            $item_link = $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
            $sHtml .= "<span>" . $titreJournal . " </span>";
            $sHtml .= "<a href='" . $item_link . "'>" . $item_title . '</a>';
            $sHtml .= "<br>";
        }

        $sHtml .= "</div></div></div>";

        return $sHtml;
    } // fin ()
} // fin classe
