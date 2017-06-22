<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 16:36
 */
?>
<div class="row">
    <div class="col-md-9">
        <div class="well">
            <h1><b><?= $article['title'] ?></b></h1>
            <?= $article['date_article'] ?>
            <img src="<?= $article['img'] ?>">
            <p><strong><?= $article['hat'] ?></strong></p>
            <p><?= $article['content'] ?></p>
        </div>
        <div class="well">
            <h2><?= count($commentaries) ?> commentaires</h2>
            <hr>
            <?php foreach ($commentaries as $commentary) : ?>
                <p>Le <?= $commentary['date_commentary'] ?> par <?= $commentary['email'] ?></p>
                <p><?= $commentary['commentary'] ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-3">
        
    </div>
</div>