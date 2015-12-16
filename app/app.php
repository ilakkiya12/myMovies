<?php

// Register global error and exception handlers
use Symfony\Component\Debug\ErrorHandler;
ErrorHandler::register();
use Symfony\Component\Debug\ExceptionHandler;
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'login' => array(
            'pattern' => '^/login$',
            'anonymous' => true
        ),
        'secured' => array(
            'pattern' => '^.*$',
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new GSB\DAO\VisiteurDAO($app['db']);
            }),
        ),
    ),
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
}));
$app->register(new Silex\Provider\ValidatorServiceProvider());


// Register services.
$app['dao.famille'] = $app->share(function ($app) {
    return new GSB\DAO\FamilleDAO($app['db']);
});
$app['dao.medicament'] = $app->share(function ($app) {
    $medicamentDAO = new GSB\DAO\MedicamentDAO($app['db']);
    $medicamentDAO->setFamilleDAO($app['dao.famille']);
    return $medicamentDAO;
});

$app['dao.typepraticien'] = $app->share(function ($app) {
    return new GSB\DAO\TypePraticienDAO($app['db']);
});
$app['dao.praticien'] = $app->share(function ($app) {
    $praticientDAO = new GSB\DAO\PraticienDAO($app['db']);
    $praticientDAO->setTypePraticienDAO($app['dao.type']);
    return $praticientDAO;
});
$app['dao.praticien'] = $app->share(function ($app) {
    $praticienDAO = new GSB\DAO\PraticienDAO($app['db']);
    $praticienDAO->setTypePraticienDAO($app['dao.typepraticien']);
    return $praticienDAO;
});
$app['dao.visiteur'] = $app->share(function ($app) {
    return new GSB\DAO\VisiteurDAO($app['db']);
});
$app['dao.rapportVisite'] = $app->share(function ($app) {
    return new GSB\DAO\RapportVisiteDAO($app['db']);
});
$app['dao.rapportVisite'] = $app->share(function ($app) {
    $rapportVisiteDao = new GSB\DAO\PraticienDAO($app['db']);
    $praticienDAO->setTypePraticienDAO($app['dao.typepraticien']);
    return $praticienDAO;
});