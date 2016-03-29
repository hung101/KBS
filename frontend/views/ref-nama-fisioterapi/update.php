<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefNamaFisioterapi */

$this->title = 'Update Ref Nama Fisioterapi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Fisioterapis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-nama-fisioterapi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
