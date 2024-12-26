<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusion des dépendances de Composer
require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\CatalogController;
use App\Controllers\MainController;

// Création d'une instance de AltoRouter
$router = new AltoRouter();

// Vérification et définition de la base URI
$baseUri = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '/';
$router->setBasePath($baseUri);

// Définition des routes
$router->addRoutes(array(
    array('GET', '/', [
        'controller' => MainController::class,
        'action' => 'home'
    ], 'home'),
    array('GET', '/mentions-legales', [
        'controller' => MainController::class,
        'action' => 'legalMentions'
    ], 'legal-mentions'),
    array('GET', '/catalogue/categorie/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'category'
    ], 'catalog-category'),
    array('GET', '/catalogue/type/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'type'
    ], 'catalog-type'),
    array('GET', '/catalogue/marque/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'brand'
    ], 'catalog-brand'),
    array('GET', '/catalogue/produit/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'product'
    ], 'catalog-product'),
    array('GET', '/test', [
        'controller' => MainController::class,
        'action' => 'test'
    ])
));

// Vérification de la correspondance de la route
$match = $router->match();

// Si une route correspond
if ($match !== false) {
    $controllerToUse = $match['target']['controller']; // Récupération du contrôleur
    $methodToUse = $match['target']['action'];         // Récupération de la méthode

    // Instanciation du contrôleur et exécution de la méthode
    $controller = new $controllerToUse();
    $controller->$methodToUse($match['params']);
}
