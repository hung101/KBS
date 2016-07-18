<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubjekSpm */

$this->title = 'Update Ref Subjek Spm: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Subjek Spms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-subjek-spm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
