<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 09:59
 */
?>

<h1>Mon blog</h1>

<?php foreach ($articles as $article) : ?>
    <div class="well">
        <div class="row">
            <div class="col-md-3">
                <img src="<?= $article['img'] ?>">
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div>
                        <h2><?= $article['title'] ?></h2>
                    </div>
                </div>
                <div class="row">
                    <?= $article['date_article'] ?>
                </div>
                <div class="row">
                    <div>
                        <p><?= $article['hat'] ?></p>
                        <a href="/?controller=show&id=<?= $article['article_id'] ?>">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>