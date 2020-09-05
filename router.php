<?php

/**
 * @file
 * Run this router to get 100 on audit adds http2 headers.
 *
 * `php -S localhost:8000 router.php`
 *
 */

header('HTTP/2.0');

//set headers to NOT cache a page
// header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
// header("Pragma: no-cache"); //HTTP 1.0
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

//or, if you DO want a file to cache, use:
header("Cache-Control: max-age=31536000");

/**
 * Variables.
 *
 * @var mixed $uri
 */
$uri = strtolower(pathinfo($_SERVER['REQUEST_URI'], PATHINFO_EXTENSION));
$file = $_SERVER['SCRIPT_FILENAME'];

$mimes = [
  'txt' => 'text/text',
  'jpg'   => 'image/jpg',
  'png'   => 'image/png',
  'jpeg'  => 'image/jpeg',
  'webp'  => 'image/webp',
  'ico'   => 'image/x-icon',
  'svg'   => 'image/svg+xml',
  'json'  => 'application/json',
  'webmanifest' => 'application/json',
  'map' => 'application/octet-stream',
  'js'    => 'application/javascript',
  'css'   => 'text/css; charset=UTF-8',
  'html'  => 'text/html; charset=UTF-8',
];


//$ext = pathinfo($uri, PATHINFO_EXTENSION);

//$mime = $mimes[$ext] ?? '';


// inspect($mime);

function testUri ($uri, $mimes) {
  return (empty($uri) || !isset($mimes[$uri])) ? false : true;
}

function extMatch($uri, $mimes) {
  if (!testUri($uri, $mimes)) return;

  header("Content-Type: {$mimes[$uri]}");
}

extMatch($uri, $mimes);

testUri($uri, $mimes) ? readfile($file) : require_once 'index.php';


