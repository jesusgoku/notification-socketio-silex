<?php

ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

class Application extends \Silex\Application
{
    use \Silex\Application\TwigTrait;
}

$app = new Application();

$app['debug'] = true;

$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

$app->get('/{user_id}', function (Application $app, $user_id) {
    return $app->render(
        'index.html.twig',
        array(
            'user_id' => $user_id
        )
    );
});

$app->get('/emit/{user_id}/{message}', function (Application $app, $user_id, $message) {
    $client = new \GuzzleHttp\Client();
    
    $response = $client->get('http://localhost:26300/emit/' . $user_id . '/' . $message);
    
    return $app->json(array(
        'content' => (string) $response->getBody(),
        'status_code' => $response->getStatusCode(),
    ));
});

$app->run();