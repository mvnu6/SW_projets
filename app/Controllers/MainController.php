<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class MainController extends CoreController
{

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
      
        $brands = Brand::findAll(); // Supposons que vous avez une classe Brand avec une méthode findAll()
        // Passer les données à la vue
        $this->show('home', [
            'categories' => $categories,
            'types' => $types,
            'brands' => $brands, // Passage des types à la vue
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