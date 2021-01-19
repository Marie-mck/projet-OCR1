<?php
namespace projet4\model;

class Vue {
    private $fichier;
    private $titre;
    private $jsFiles;
    
    public function __construct($action) {
        $this->fichier = "view/" . $action . ".php";
    }

    // Génère et affiche la vue:
    public function generer($donnees):void {
        $contenu = $this->genererFichier($this->fichier, $donnees);
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('view/template.php', array('jsFiles' => $this->jsFiles, 'titre' => $this->titre, 'contenu' => $contenu));
        // Renvoi de la vue au navigateur
        echo $vue;
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function genererFichier($fichier, $donnees) {
        if (file_exists($fichier)) {
        // Rend les éléments du tableau $donnees accessibles dans la vue
        extract($donnees);
        // Démarrage de la temporisation de sortie
        ob_start();
        // Inclut le fichier vue
        // Son résultat est placé dans le tampon de sortie
        require $fichier;
        // Arrêt de la temporisation et renvoi du tampon de sortie
        return ob_get_clean();
        }
        else {
        //throw new Exception("Fichier '.$fichier.' introuvable");
        }
    }
    public function setTitre($titre) {
        $this->titre = $titre;
    }
    public function addJsFile($jsFile) {
        $this->jsFiles[] = $jsFile;
    }
}