## 0. Installation

In the following, I assume your website is located under http\[s\]://domain/topic/ 
and is named "website" (adapt to your case). For example, in https://github.com/blog/ 
domain = github.com and topic = blog.

Get the source code either with `git clone` command or using a zip archive. 
Copy all folder contents in the website/ folder : 
<pre>website/
    a/
    f/
    site/
    .htaccess
    common.php
    defaults.php
    index.php
    s.php
</pre>
- **a/** (for "assets") is the folder for CSS files, images and javascript codes. 
I like to put them respectively in css/, img/ and js/ folders, but the choice is yours.
- **f/** (for "files") is the folder for any downloadable (or browsable) file you may upload. 
- **site/** is the main folder containing all your website pages. Three are already there :
  - **404.php** : the 404 error page;
  - **dl.php** : a script to download binary files;
  - **home.php** : the specifications for the welcome page.
- **.htaccess** : its main job consists in routing everything that is not a resource 
to the index.php file. 
- **common.php** contains shared variables and functions to be used by at least two different pages.
- **defaults.php** defines default variables for any web page, like the title or javascripts block.
- **index.php** contains your website template, which is rendered for any web page 
(and filled with specific values defined in pages under site/ folder; anything can be customized).
- **s.php** consists in the framework code, loaded at the beginning of index.php.

Now (online), in the .htaccess file, change the line `RewriteBase /` to `RewriteBase /topic`.

## 1. Set default contents

Edit the file defaults.php with
- A global title to your website; this title can later be mixed with a more specific 
page-based title, or be replaced.
- A list of references to CSS style sheets and pre-rendering javascript, like 
`<link rel="stylesheet" href="http://cran.r-project.org/R.css"/>`. 
We will see later how to refer to local style sheets (under a/css).
- Some javascript code which will be loaded by default after every page loads
(e.g. [jquery](http://jquery.com/)).

Each variable name is prepended with "b\_" to avoid potential conflicts with your own variables.

## 2. Complete main pages

### index.php

Complete
- The menu (at commented location)
- The banner (near the menu, if you want one)
- The footer (if you don't want one, just drop it).

You can also change the \<meta\> tags if needed.

### site/home.php

The welcome page. You can choose a title ($s\_title) or use the default one 
(by not specifying anything). Style sheets and javascripts can be customized, ...etc. 
Any default variable can be used to define a specific variable (prepended with "s\_"). 

### site/404.php

Customize it; it is probably viewed more often than you think ;-)

## 3. Write all other pages

All pages are under site/ folder, and you can nest them in any directory tree.

**Hint** : if you don't want to load the main template, just end any site file 
with a PHP `exit` directive.

Now we will see how to access pages and resources (images, CSS, files, javascript).

<p>&nbsp;</p>
--------------------------------------------------

## How to view a web page ?

The page at physical location site/some\_folder/mypage.php is viewed in the web browser at the URL 
http\[s\]://domain/topic/website/some\_folder/mypage (thanks to URL rewriting defined in 
the .htaccess file). 

Any page can be linked internally using the `r()` PHP function ('r' for "resource"), like in 
the following : `<a href="<?php echo r('some_folder/mypage'); ?>">'`. This function determines 
the nesting level and output the appropriate path.

## How to access...

*A CSS style sheet* : its path is given by the following PHP function call 
`r('a/css/name_of_the_file.css')` from within any site file (assuming you place all CSS files 
under a/css/. They may be inside a nested folder structure).

*An image* : same as above, with `r('a/img/name_of_the_image.xxx')`.

*A javascript file* : same as above, with `r('a/js/name_of_the_file.js')`.

## How to give a download link ?

Just use a regular link pointing to `r('dl/?f=name_of_the_file.xxx')`, anywhere you want.

<p>&nbsp;</p>
--------------------------------------------------

## Usual workflow

Just add pages under site/ folder, and potential resources and files under a/ and f/. 
All other files will not change a lot.
