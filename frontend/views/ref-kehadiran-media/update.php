<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKehadiranMedia */

$this->title = 'Update Ref Kehadiran Media: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kehadiran Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kehadiran-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
