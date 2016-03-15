<?php
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;


// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
}));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new MicroCMS\DAO\UserDAO($app['db']);
            }),
        ),
    ),
    'security.access_rules' => array(
        array('^/home', 'ROLE_USER'),
    ),
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

// Register services
$app['dao.recense'] = $app->share(function ($app) {
   return new MicroCMS\DAO\RecenseDAO($app['db']); 
});

$app['dao.residence'] = $app->share(function ($app) {
    return new MicroCMS\DAO\ResidenceDAO($app['db']);
});

$app['dao.user'] = $app->share(function ($app) {
    return new MicroCMS\DAO\UserDAO($app['db']);
});

$app['dao.villes'] = $app->share(function ($app) {
    return new MicroCMS\DAO\VillesDAO($app['db']);
});

$app['dao.filliationParent'] = $app->share(function ($app) {
    return new MicroCMS\DAO\FilliationParentDAO($app['db']);
});

$app['dao.nationalites'] = $app->share(function ($app) {
    return new MicroCMS\DAO\NationalitesDAO($app['db']);
});

$app['dao.situationFamille'] = $app->share(function ($app) {
    return new MicroCMS\DAO\SituationFamilleDAO($app['db']);
});


$app['dao.situationMatrimonial'] = $app->share(function ($app) {
    return new MicroCMS\DAO\SituationMatrimonialDAO($app['db']);
});


$app['dao.situationScolaire'] = $app->share(function ($app) {
    return new MicroCMS\DAO\SituationScolaireDAO($app['db']);
});


$app['dao.profession'] = $app->share(function ($app) {
    return new MicroCMS\DAO\ProfessionDAO($app['db']);
});


/*
// Register error handler
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 403:
            $message = 'Access refusé.';
            break;
        case 404:
            $message = 'La requete ne peut etre trouvé.';
            break;
        default:
            $message = "Quelque chose ne va pas.";
    }
    return $app['twig']->render('error.html.twig', array('message' => $message));
});
*/
// Register JSON data decoder for JSON requests
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});
