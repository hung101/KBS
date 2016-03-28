<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiRehabilitasi */

$this->title = 'Update Ref Status Temujanji Rehabilitasi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Temujanji Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-temujanji-rehabilitasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
