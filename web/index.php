<?php

require __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local;
use Transliterator\Transliterator;
use Transliterator\Settings;
use Titlerator\Titlerator;

$app = new Application();

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->post('/convert', function (Request $request) use ($app) {
    $file = $request->files->get('title');

    if (null === $file) {
        return $app['twig']->render('index.html.twig', ['error' => 'Титл није изабран.']);
    }

    if (!$file->isValid()) {
        return $app['twig']->render('index.html.twig', ['error' => 'Дошло је до грешке при отпремању титла.']);
    }

    if (!in_array($file->getClientMimeType(), ['application/x-subrip', 'text/x-microdvd', 'text/plain'])) {
        return $app['twig']->render('index.html.twig', ['error' => 'Изабранa датотека није титл.']);
    }

    $filesystem = new Filesystem(new Local('/'));

    $titlerator = new Titlerator(
        new Transliterator(Settings::LANG_SR),
        $filesystem->read($file->getRealPath())
    );
    $titlerator->fixEncoding();
    $titlerator->transliterate($request->request->has('latin'));

    return new Response(
        $titlerator->getText(),
        200,
        [
            'Content-Type'        => $file->getClientMimeType(),
            'Content-Disposition' => sprintf('attachment; filename="%s"', $file->getClientOriginalName())
        ]
    );
})->bind('convert');

$app
    ->register(new UrlGeneratorServiceProvider())
    ->register(new TwigServiceProvider(), ['twig.path' => __DIR__.'/../views'])
;

$app->run();
