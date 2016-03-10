<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiPesakitLuar */

$this->title = 'Update Ref Status Temujanji Pesakit Luar: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Temujanji Pesakit Luars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-temujanji-pesakit-luar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
