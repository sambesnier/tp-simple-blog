<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 11:19
 */
?>

<h1>Nouvel article</h1>

<?php if (count($errors) > 0) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="well">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>

    <div class="form-group">
        <label for="hat">Chapô</label>
        <textarea rows="3" name="hat" id="hat" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="content">Texte</label>
        <textarea rows="8" name="content" id="content" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="photo">Image de l'article</label>
        <input type="file" name="photo">
    </div>
    <h2>Les catégories</h2>
    <div class="form-group" id="categories_list">
        <div class="form-category hidden">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-control" name="categories[]">
                        <option value="0">Choisir une catégorie</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['category_name'] ?>"><?= $category['category_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-danger delete">Supprimer</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <select class="form-control" name="categories[]">
                    <option value="0">Choisir une catégorie</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['category_name'] ?>"><?= $category['category_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" id="add-category">Ajouter une catégorie</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 pull-right">
            <button class="btn btn-success" name="submit" type="submit">Ajouter</button>
        </div>
    </div>
    </form>
</div>
