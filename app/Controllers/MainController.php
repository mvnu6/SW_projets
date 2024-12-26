<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class MainController extends CoreController
{

    public function test()
    {
        $brandModel = new Brand(); // peut modifier Brand avec les autres noms de modèle pour tester
        $list = $brandModel->findAll();
        $elem = $brandModel->find(7);
        dump($list);
        dump($elem);
    }
    /**
     * Affiche la page d'accueil du site
     */
    public function home()
    {
        // Récupérer les catégories
        $categoryModel = new Category();
        $categories = $categoryModel->findAllForHomePage();

        // Récupérer les types
        $typeModel = new Type();
        $types = $typeModel->findAll();

        // Passer les données à la vue
        $this->show('home', [
            'categories' => $categories,
            'types' => $types, // Passage des types à la vue
        ]);
    }

    /**
     * Show legal mentions page
     */
    public function legalMentions()
    {
        // Affiche la vue dans le dossier views
        $this->show('mentions');
    }
    
}