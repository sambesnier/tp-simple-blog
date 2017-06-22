<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 16:36
 */

$id = $_GET['id'];
$errors = [];

$article = [];
$categories = [];
$commentaries = [];

$connection = getPDO();

// Test of form submission
$isSubmitted = filter_has_var(INPUT_POST, "submit");

if (! empty($isSubmitted)) {
    $email = filter_input(
        INPUT_POST,
        'email',
        FILTER_SANITIZE_EMAIL);
    // Get data
    $commentary = filter_input(
        INPUT_POST,
        'commentary',
        FILTER_SANITIZE_STRING);

    if (empty($email)) {
        $errors[] = "Veuillez saisir un email";
    }
    if (empty($commentary)) {
        $errors[] = "Veuillez saisir un commentaire";
    }
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO commentaries (email, commentary, article_id) VALUES (:email, :commentary, :article_id)";
            $statement = $connection->prepare($sql);
            $statement->execute([
                'email' => $email,
                'commentary' => $commentary,
                'article_id' => $id
            ]);
            $_SESSION['flash'] = "Votre commentaire a été ajouté";
        } catch (PDOException $e) {
            $errors[] = "Impossible d'ajouter votre commentaire";
        }
    }
}

// Get articles
try {
    $sql = "SELECT title, hat, img, content, articles.article_id, date_article FROM articles WHERE article_id=$id";
    $rs = $connection->query($sql);
    $article = $rs->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errors[] = "Article introuvable";
}

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

// Get commentaries
try {
    $sql = "SELECT email, commentary, date_commentary
            FROM commentaries
            WHERE article_id = $id";
    $rs = $connection->query($sql);
    $commentaries = $rs->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errors[] = "Impossible d'afficher les commentaires";
}

// Call renderView function
renderView(
    'show',
    [
        'pageTitle' => $article['title'],
        'article' => $article ?? [],
        'categories' => $categories ?? [],
        'commentaries' => $commentaries ?? [],
        'errors' => $errors
    ]
);