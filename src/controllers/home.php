<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 09:58
 */

$connection = getPDO();

$errors = [];
$articles = [];
$categories = [];

$sql = "SELECT title, hat, img, articles.article_id, date_article FROM articles";
$rs = $connection->query($sql);
$articles = $rs->fetchAll(PDO::FETCH_ASSOC);

// Get catégories
try {
    $sql = "SELECT categories.category_name
            FROM categories
            INNER JOIN
            articles_categories ON categories.category_name = articles_categories.category_name
            INNER JOIN
            articles ON articles.article_id = articles_categories.article_id";
    $rs = $connection->query($sql);
    $categories = $rs->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errors[] = "Impossible d'afficher les catégories";
}

// Call renderView function
renderView(
    'home',
    [
        'pageTitle' => 'Bienvenue sur mon blog',
        'articles' => $articles ?? []
    ]
);