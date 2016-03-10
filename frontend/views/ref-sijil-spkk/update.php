<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSijilSpkk */

$this->title = 'Update Ref Sijil Spkk: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sijil Spkks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sijil-spkk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
