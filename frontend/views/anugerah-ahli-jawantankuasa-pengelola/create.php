<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahAhliJawantankuasaPengelola */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_ahli_jawantankuasa_pengelola;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_ahli_jawantankuasa_pengelola, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pengelola-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
