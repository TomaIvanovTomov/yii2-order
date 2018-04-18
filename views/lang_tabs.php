<?php
?>
<ul class="nav nav-tabs">

    <?php foreach (Yii::$app->params['language-information'] as $id => $language) : ?>

        <li class="<?= ($id == "BG") ? "active" : "" ?>">
            <a data-toggle="tab" href="#<?= $id ?>"><?= $language['title'] ?></a>
        </li>

    <?php endforeach; ?>

</ul>