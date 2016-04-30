<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefBeratBadan */

$this->title = 'Update Ref Berat Badan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Berat Badans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-berat-badan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>