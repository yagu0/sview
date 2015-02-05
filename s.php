<?php

//Function to get resources (using $nlevels below)
function r($toppath) {
	global $nlevels;
	$res = '';
	for ($i=0; $i<$nlevels; $i++)
		$res .= '../';
	$res .= $toppath;
	return $res;
}

//////////////////////////////////////////////////

//Start buffering output
ob_start();

//Report any error
error_reporting(E_ALL);

//Sub-path path to the currently running script. If we're directly on top of a
//domain, this will probably be empty, else for instance: /john/mysite
$subpath = str_replace('/index.php', '', $_SERVER['PHP_SELF']);

//Turn a request like /john/mysite/get/page.php?a=32 into /get/page.php?a=32
$request = str_replace($subpath, '', $_SERVER['REQUEST_URI']);

//Turn a request like /get/page.php?a=32 into get/page?a=32
$request = str_replace('.php', '', $request);

//Keep only what stands before '?' : get/page
$location = trim(explode('?', $request)[0], '/');
//[HACK] The following works better on my university server
//~ $interrmark = strrpos($request, '?');
//~ $location = trim(($interrmark!==FALSE ? substr($request,0,$interrmark) : $request), '/');

//If the user asked for main index.php, consider he wanted home page
if ($location == 'index') $location = '';

//[HACK] Count the number of sub-levels to go up to meet assets folder
$nlevels = substr_count($location, '/');

//Turn get/page into site/get/page.php
$phpfile = 'site/'.(strlen($location)>0?$location:'home').'.php';

//Include default values for title, headers, javascripts...
include 'defaults.php';

//Include common PHP code (functions and constants)
include 'common.php';

//Finally, include the PHP file
include (file_exists($phpfile) ? $phpfile : 'site/404.php');

//regular template: flush output into $content variable
$content = ob_get_contents();
ob_end_clean();
