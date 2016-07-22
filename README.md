# sview : tiny PHP web framework

It is inspired by [a similar framework](https://github.com/arnorhs/ShortPHP) written by Arn&oacute;r Hei&#240;ar Sigur&#240;sson. 
In the same spirit but more advanced and more complete, see also [nanoc](http://nanoc.ws/) - in Ruby.

sview is designed to organize essentially static websites. 
It does not offer the features you would expect from a complete MVC framework - 
actually, it has only the "V" part. 
If you want a more demanding dynamic website, consider using an appropriate tool, 
[Symfony](http://symfony.com/) for example.

## How to use it ?

The file sample-website.tar.xz provides a basic but full website example. 
Alternatively, here are some details about sview usage.

## 0. Installation

In the following, I assume your website is located under http\[s\]://domain/topic/ 
and is named "website" (adapt to your case). For example, in https://github.com/blog/ 
domain = github.com and topic = blog.

Get the source code either with `git clone` command or using a zip archive. 
Copy all folder contents in the website/ folder : 

	website/
	  a/
	  f/
	  site/
    .htaccess
	  common.php
    defaults.php
    index.php
    s.php</pre>

* __a/__ (for "assets") is the folder for CSS files, images and javascript codes. 
		I like to put them respectively in css/, img/ and js/ folders, but the choice is yours.
* __f/__ (for "files") is the folder for any downloadable (or browsable) file you may upload.
* __site/__ is the main folder containing all your website pages. Three are already there :
	* _404.php_ : the 404 error page;
	* _dl.php_ : a script to download binary files;
	* _home.php_ : the specifications for the welcome page.
* __.htaccess__ : its main job consists in routing everything that is not a resource to the index.php file.
* __common.php__ contains shared variables and functions to be used by at least two different pages.
* __defaults.php__ defines default variables for any web page, like the title or javascripts block.
* __index.php__ contains your website template, which is rendered for any web page 
		(and filled with specific values defined in pages under site/ folder; anything can be customized).
* __s.php__ consists in the framework code, loaded at the beginning of index.php.

Now (online), in the .htaccess file, change the line `RewriteBase /` to `RewriteBase /topic`.

## 1. Set default contents

Edit the file defaults.php with

* A global title to your website; this title can later be mixed with a more specific page-based title, or be replaced.
* A list of references to CSS style sheets and pre-rendering javascripts, like `<link rel="stylesheet" href="http://cran.r-project.org/R.css"/>`. 
		We will see later how to refer to local style sheets (under a/css).
* Some javascript code which will be loaded by default after every page loads (e.g. [jQuery](http://jquery.com/).

Each variable name is prepended with "b\_" to avoid potential conflicts with your own variables.

## 2. Complete main pages

### index.php

Complete

* The menu (at commented location)
* The banner (near the menu, if you want one)
* The footer (if you don't want one, just drop it).

You can also change the &lt;meta&gt; tags if needed.

### site/home.php

The welcome page. You can choose a title ($s\_title) or use the default one 
(by not specifying anything). Style sheets and javascripts can be customized, ...etc. 
Any default variable can be used to define a specific variable (prepended with "s\_").

### site/404.php

Customize it; it is probably viewed more often than you think ;-)

## 3. Write all other pages

All pages are under site/ folder, and you can nest them in any directory tree.

__Hint__ : if you don't want to load the main template, just end any site file with a PHP `exit` directive.

Now we will see how to access pages and resources (images, CSS, files, javascript).

---

## How to view a web page ?

The page at physical location site/some\_folder/mypage.php is viewed in the web browser at the URL 
http\[s\]://domain/topic/website/some\_folder/mypage (thanks to URL rewriting defined in the .htaccess file). 

Any page can be linked internally using the `r()` PHP function ('r' for "resource"), like in 
the following : `<a href="<?php echo r('some_folder/mypage'); >>`. This function determines 
the nesting level and output the appropriate path.

## How to access...

_A CSS style sheet_ : its path is given by the following PHP function call 
`r('a/css/name_of_the_file.css')` from within any site file (assuming you place all CSS files 
under a/css/. They may be inside a nested folder structure).

_An image_ : same as above, with `r('a/img/name_of_the_image.xxx')`.

_A javascript file_ : same as above, with `r('a/js/name_of_the_file.js')`.

## How to give a download link ?

Just use a regular link pointing to `r('dl/?f=name_of_the_file.xxx')`, anywhere you want.

---

## Usual workflow

Just add pages under site/ folder, and potential resources and files under a/ and f/. 
All other files will not change a lot.
