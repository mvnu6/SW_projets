<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use App\Utils\Database;

class CoreController 
{
    /**
     * Fonction qui permet d'afficher la vue
     * $viewData = les données que je veux récupérer dans ma vue
     */
    public function show($viewName, $viewData = [])
{
    $absoluteURL = $_SERVER['BASE_URI'];
    global $router;

    // Récupérer les catégories
    $categoryModel = new Category();
    $categories = $categoryModel->findAll();
    $viewData['categories'] = $categories; // Ajout des catégories aux données de la vue

    // Récupérer les types
    $typeModel = new Type();
    $types = $typeModel->findAll();
    $viewData['types'] = $types; // Ajout des types aux données de la vue

    // Récupérer les marques (si nécessaire)
    $brandModel = new Brand();
    $brands = $brandModel->findAll();
    $viewData['brands'] = $brands; // Ajout des marques aux données de la vue

    // Inclure les vues (header, contenu principal, footer)
    require_once __DIR__ . "/../views/partials/header.tpl.php";
    require_once __DIR__ . "/../views/$viewName.tpl.php";
    require_once __DIR__ . "/../views/partials/footer.tpl.php";
}

}