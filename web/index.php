<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

error_reporting(error_reporting() & ~E_USER_DEPRECATED);
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__."/../app/config/parameters.yml"));
$app->get(
    '/',
    function () use ($app) {
        return $app->redirect('https://www.devboard.xyz/');
    }
);

$app->post(
    '/github/',
    function (Request $request) use ($app) {

        $webHookSecret = $app['parameters']['github_webhook_secret'];
        $beanstalkIp = $app['parameters']['beanstalk'];

        $eventFactory = new \DevBoard\Notify\EventFactory();
        $securityChecker = new \DevBoard\Notify\EventSecurityChecker($webHookSecret);

        $event = $eventFactory->create($request);

        if (!$securityChecker->check($event)) {
            return new Response('Wrong sig!', 400);
        }

        $pheanstalk = new \Pheanstalk\Pheanstalk($beanstalkIp);

        $pheanstalk
            ->useTube('github-tube')
            ->put(json_encode($event));

        return new Response('Received!', 200);
    }
);

$app->run();
