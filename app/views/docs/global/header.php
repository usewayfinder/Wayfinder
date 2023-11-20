<?php

// cache busting
$v = 2021.20;

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
<?php if(isset($metaDescription)) { ?>
    <meta name="description" content="<?php echo strip_tags($metaDescription); ?>" />
<?php } ?>
    <meta name="keywords" content="routing, route, custom routes, routing framework, framework for routing, php, php mvc, mvc php, phpmvc, mvcphp, mvc framework, rapid prototyping, prototyping, rapidly prototype" />
    <meta name="author" content="Charanjit Chana" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.png?cache=<?php echo $v; ?>" />
    <link rel="stylesheet" type="text/css" href="/css/docs.css?cache=<?php echo $v; ?>" />
    <title><?php if(isset($title)) { echo strip_tags($title).' — '; } ?>Wayfinder ↗︎</title>
    <meta name="apple-mobile-web-app-title" content="Wayfinder" />
    <meta name="application-name" content="Wayfinder" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:creator" content="@cchana" />
    <meta name="twitter:title" content="<?php echo strip_tags($title); ?>" />
<?php if(isset($subtitle)) { ?>
    <meta name="twitter:description" content="<?php echo $subtitle; ?>" />
<?php } ?>
    <meta name="twitter:image" content="https://www.usewayfinder.com/images/social-square.png?cache=<?php echo $v; ?>" />
    <meta property="og:site_name" content="Wayfinder"/>
    <meta property="og:url" content="https://www.usewayfinder.com<?php echo REQUEST_URI; ?>" />
    <meta property="og:title" content="<?php echo strip_tags($title); ?>" />
<?php if(isset($subtitle)) { ?>
    <meta property="og:description" content="<?php echo $subtitle; ?>" />
<?php } ?>
    <meta property="og:image" content="https://www.usewayfinder.com/images/social-square.png?cache=<?php echo $v; ?>" />
    <meta property="og:type" content="article" />
<?php if(isset($noIndex) && $noIndex) { ?>
    <meta name="robots" content="noindex" />
<?php } ?>
</head>
<body<?php

if(isset($pageId)) {
    echo ' id="'.$pageId.'"';
}

?>>

<main>

    <header>

        <nav>
            <ul>
                <li <?php if(REQUEST_URI == '/') {echo 'class="active"';} ?>><a href="/">Wayfinder</a></li>
                <li <?php if(strpos(REQUEST_URI, '/documentation') === 0) {echo 'class="active"';} ?>><a href="/documentation">Docs</a></li>
                <li <?php if(REQUEST_URI == '/examples') {echo 'class="active"';} ?>><a href="/examples">Examples</a></li>
                <li <?php if(REQUEST_URI == '/changelog') {echo 'class="active"';} ?>><a href="/changelog">Change log</a></li>
                <li><a href="https://github.com/usewayfinder/Wayfinder" target="_blank">GitHub</a></li>
            </ul>
        </nav>

        <h1><?php echo $title; ?></h1>

    </header>

    <article>

        <?php if(isset($subtitle)) { ?>
        <h2><?php echo $subtitle; ?></h2>
        <?php } ?>
