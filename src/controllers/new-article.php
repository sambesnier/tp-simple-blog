<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 11:18
 */

$connection = getPDO();
$errors = [];

// Test of form submission
$isSubmitted = filter_has_var(INPUT_POST, "submit");

if (! empty($isSubmitted)) {
    // Get data
    $title = filter_input(
        INPUT_POST,
        'title',
        FILTER_SANITIZE_STRING);
    $hat = filter_input(
        INPUT_POST,
        'hat',
        FILTER_SANITIZE_STRING);
    $content = filter_input(
        INPUT_POST,
        'content',
        FILTER_SANITIZE_EMAIL);
    $categoriesFromForm = filter_input(
        INPUT_POST,
        'categories',
        FILTER_SANITIZE_STRING,
        FILTER_REQUIRE_ARRAY) ?? [];
    $photoPath = "";
    $categories = [];

    // Error handling
    if (empty($title)) {
        $errors[] = "Vous devez saisir un titre";
    }
    if (empty($hat)) {
        $errors[] = "Vous devez saisir un chapô";
    }
    if (empty($content)) {
        $errors[] = "Vous devez rédiger un texte";
    }
    $isSet = true;
    for ($i = 1; $i < count($categoriesFromForm); $i++) {
        if($categoriesFromForm[$i] == "0") {
            $isSet = false;
        } else {
            $categories[] = $categoriesFromForm[$i];
        }
    }
    if (!$isSet) {
        $errors[] = "Une ou plusieurs catégories ne sont pas renseignées";
    }

    // Photo download
    if(isset($_FILES["photo"])) {
        $upload = $_FILES["photo"];
        $extension ="";

        // Set extension
        if($upload['type'] == 'image/jpeg') {
            $extension = '.jpg';
        }

        if(!empty($extension)) {
            // Set name and destination path
            $destPath = getcwd()."/public/img/photos/";
            $uniqPath = uniqid("photo_").$extension;
            $destPath .= $uniqPath;

            // Move temp file to destination
            $success = move_uploaded_file($upload['tmp_name'], $destPath);
            if(! $success) {
                $errors[] = "Impossible de télécharger votre photo";
            } else {
                $photoPath = "/public/img/photos/".$uniqPath;
            }
        } else {
            $errors[] = "Mauvais format de photo";
        }
    } else {
        $errors[] = "Veuillez ajouter une photo";
    }

    // If no error then add article in database
    if (empty($errors)) {
        try {
            $connection->beginTransaction();
            $sql = "CALL add_article(?, ?, ?, ?)";
            $statement = $connection->prepare($sql);
            $statement->execute([
                $title,
                $hat,
                $content,
                $photoPath
            ]);
            foreach ($categories as $category) {
                $sql = "INSERT INTO articles_categories (article_id, category_name) VALUES (@id,?)";
                $statement = $connection->prepare($sql);
                $statement->execute([$category]);

            }
            $connection->commit();
            $_SESSION["flash"] = "Article ajouté";
        } catch (PDOException $e) {
            $_SESSION["flash"] = "Impossible d'ajouter l'article";
            $connection->rollBack();
        }
        header("location:/?controller=home");
        exit();
    }

}

// Get category names
$sql = "SELECT category_name FROM categories ORDER BY category_name";
$rs = $connection->query($sql);
$categoriesForm = $rs->fetchAll(PDO::FETCH_ASSOC);



// Call renderView function
renderView(
    'new-article',
    [
        'pageTitle' => 'Nouvel article',
        'categories' => $categoriesForm,
        'errors' => $errors
    ]
);