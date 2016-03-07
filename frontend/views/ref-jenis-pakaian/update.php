<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPakaian */

$this->title = 'Update Ref Jenis Pakaian: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Pakaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-pakaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
