<?php 

// Classe où l'on retire les dernières nouvelles 
class Nouvelle
{ 
    // Permet de get l'information à partir du URL donné 
    // @return XML
    public function getNouvelles(){

        // Fichier XML avec l'information
        $xml=("https://www.ledevoir.com/rss/manchettes.xml");

        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);

        //GET elements dans le channel
        $channel = $xmlDoc->getElementsByTagName('channel')->item(0);
        $channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
        $channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;

        // Éléments dans le channel
        echo("<p><a href='" . $channel_link . "'>" . $channel_title . "</a>");
        echo("<br>");

        // Prend et affiche les éléments items, le titre et le lien vers l'article. (TEST)
        $x=$xmlDoc->getElementsByTagName('item');

        // changer la valeur de i pour augmenter le nombres de nouvelles (4 articles sont retournés pour l'instant)
        for ($i=0; $i<=2; $i++) {
            
            $item_title = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
            $item_link = $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
            
            echo ("<p><a href='" . $item_link . "'>" . $item_title . "</a>");
        }
    }// fin ()
} 

