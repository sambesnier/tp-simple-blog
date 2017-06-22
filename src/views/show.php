<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 16:36
 */
?>
<div class="row">
    <div class="col-md-8">
        <div class="well">
            <h1><b><?= $article['title'] ?></b></h1>
            <?= $article['date_article'] ?>
            <img src="<?= $article['img'] ?>">
            <p><strong><?= $article['hat'] ?></strong></p>
            <p><?= $article['content'] ?></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well">
            <div class="row">
                <h2>Billets par catégories</h2>
            </div>
            <div class="row">
                <h2>Historique</h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="well">
        <div class="row">
            <div class="col-md-8">
                <h2><?= count($commentaries) ?> commentaires</h2>
                <?php foreach ($commentaries as $commentary) : ?>
                    <hr>
                    <p>Le <?= $commentary['date_commentary'] ?> par <?= $commentary['email'] ?></p>
                    <p><?= $commentary['commentary'] ?></p>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4">
                <h2>Commenter ce billet</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="email">Votre email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="commentary">Votre commentaire</label>
                        <textarea class="form-control" rows="4" id="commentary" name="commentary"></textarea>
                    </div>
                    <button class="btn btn-success" name="submit" type="submit">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>