<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKelayakanAkademik */

$this->title = 'Update Ref Kelayakan Akademik: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelayakan Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kelayakan-akademik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
