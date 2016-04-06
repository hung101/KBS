<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisTemujanjiPesakitLuar */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Temujanji Pesakit Luar';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Temujanji Pesakit Luars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-temujanji-pesakit-luar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
