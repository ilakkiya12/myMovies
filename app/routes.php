<?php

use Symfony\Component\HttpFoundation\Request;

// Page d'accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
})->bind('home');

// Détails sur un médicament
$app->get('/medicament/{id}', function($id) use ($app) {
    $medicament = $app['dao.medicament']->find($id);
    return $app['twig']->render('medicament.html.twig', array('medicament' => $medicament));
})->bind('medicament');

// Liste de tous les médicaments
$app->get('/medicament/', function() use ($app) {
    $medicaments = $app['dao.medicament']->findAll();
    return $app['twig']->render('medicaments.html.twig', array('medicaments' => $medicaments));
})->bind('medicaments');

// Recherche de médicaments
$app->get('/medicament/recherche/', function() use ($app) {
    $familles = $app['dao.famille']->findAll();
    return $app['twig']->render('medicaments_recherche.html.twig', array('familles' => $familles));
})->bind('medicament_recherche');

// Résultats de la recherche de médicaments
$app->post('/medicament/resultats/', function(Request $request) use ($app) {
    $familleId = $request->request->get('famille');
    $medicaments = $app['dao.medicament']->findAllByFamille($familleId);
    return $app['twig']->render('medicaments_resultats.html.twig', array('medicaments' => $medicaments));
})->bind('medicament_resultats');


// Détails sur un praticien
$app->get('/praticien/{id}', function($id) use ($app) {
    $praticien = $app['dao.praticien']->find($id);
    return $app['twig']->render('praticien.html.twig', array('praticien' => $praticien));
})->bind('praticien');

// Liste de tous les praticiens
$app->get('/praticien/', function() use ($app) {
    $praticiens = $app['dao.praticien']->findAll();
    return $app['twig']->render('praticiens.html.twig', array('praticiens' => $praticiens));
})->bind('praticiens');

// Recherche de praticiens par type
$app->get('/praticien/recherche/', function() use ($app) {
    $typesPraticiens = $app['dao.typepraticien']->findAll();
    return $app['twig']->render('praticiens_recherche_type.html.twig', array('types' => $typesPraticiens));
})->bind('praticien_recherche_type');

// Résultats de la recherche de praticiens par type
$app->post('/praticien/resultats/', function(Request $request) use ($app) {
    $typeId = $request->request->get('type');
    $typesPraticiens = $app['dao.praticien']->findAllByType($typeId);
    return $app['twig']->render('praticiens_resultats.html.twig', array('praticiens' => $typesPraticiens));
})->bind('praticien_resultats');

//Login form 
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
        ));
})->bind('login');

// Profil utilisateur
$app->match('/profil', function(Request $request) use ($app) {
    $visiteur = $app['user'];
    $visiteurFormView = null;
    $visiteurForm = $app['form.factory']->create(new VisiteurType(), $visiteur);
    $visiteurForm->handleRequest($request);
    if ($visiteurForm->isSubmitted() && $visiteurForm->isValid()) {
        $plainPassword = $visiteur->getPassword();
        // find the encoder for a UserInterface instance
        $encoder = $app['security.encoder_factory']->getEncoder($visiteur);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $visiteur->getSalt());
        $visiteur->setPassword($password); 
        $app['dao.visiteur']->save($visiteur);
        $app['session']->getFlashBag()->add('success', 'Vos informations personnelles ont été mises à jour.');
    }
    $visiteurFormView = $visiteurForm->createView();
    return $app['twig']->render('visiteur.html.twig', array('visiteurForm' => $visiteurFormView));
})->bind('profil');



// Liste de tous les rapport
$app->get('/rapportVisite/', function() use ($app) {
    $rapportVisites = $app['dao.rapportVisite']->findAll();
    return $app['twig']->render('rapport_visites.html.twig', array('rapportVisites' => $rapportVisites));
})->bind('rapport_visites');
