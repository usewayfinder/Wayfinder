<?php

// cache busting
$v = 5;

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.png?cache=<?php echo $v; ?>" />
    <link rel="stylesheet" type="text/css" href="/css/docs.css?cache=<?php echo $v; ?>" />
    <title><?php echo $title; ?></title>
    <meta name="apple-mobile-web-app-title" content="Wayfinder">
    <meta name="application-name" content="Wayfinder">
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="<?php echo $title; ?>"/>
    <?php if(isset($subtitle)) { ?>
    <meta name="twitter:description" content="<?php echo $subtitle; ?>"/>
    <?php } ?>
    <meta property="og:site_name" content="Wayfinder"/>
    <meta property="og:url" content="https://www.usewayfinder.com"/>
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <?php if(isset($subtitle)) { ?>
    <meta property="og:description" content="<?php echo $subtitle; ?>"/>
    <?php } ?>
    <meta property="og:type" content="article"/>
</head>
<body>

<main>

    <header>

        <nav>
            <ul>
                <li <?php if($_SERVER['REQUEST_URI'] == '/') {echo 'class="active"';} ?>><a href="/">Wayfinder</a></li>
                <li <?php if($_SERVER['REQUEST_URI'] == '/docs') {echo 'class="active"';} ?>><a href="/docs">Docs</a></li>
                <li <?php if($_SERVER['REQUEST_URI'] == '/examples') {echo 'class="active"';} ?>><a href="/examples">Examples</a></li>
                <li <?php if($_SERVER['REQUEST_URI'] == '/changelog') {echo 'class="active"';} ?>><a href="/changelog">Changelog</a></li>
                <li><a href="https://github.com/cchana/Wayfinder" target="_blank">GitHub</a></li>
            </ul>
        </nav>

        <h1><?php echo $title; ?></h1>
        <?php if(isset($subtitle)) { ?>
        <h2><?php echo $subtitle; ?></h2>
        <?php } ?>

    </header>

    <article>
