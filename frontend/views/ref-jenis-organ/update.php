<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisOrgan */

$this->title = 'Update Ref Jenis Organ: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Organs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-organ-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
