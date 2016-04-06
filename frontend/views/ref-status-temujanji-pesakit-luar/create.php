<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiPesakitLuar */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Temujanji Pesakit Luar';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Temujanji Pesakit Luars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-temujanji-pesakit-luar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
