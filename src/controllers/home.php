<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 09:58
 */

$connection = getPDO();

$sql = "SELECT title, hat, img, articles.article_id FROM articles";
$rs = $connection->query($sql);
$articles = $rs->fetchAll(PDO::FETCH_ASSOC);

// Call renderView function
renderView(
    'home',
    [
        'pageTitle' => 'Bienvenue sur mon blog',
        'articles' => $articles ?? []
    ]
);