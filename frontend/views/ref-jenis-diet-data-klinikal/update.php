<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisDietDataKlinikal */

$this->title = 'Update Ref Jenis Diet Data Klinikal: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Diet Data Klinikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-diet-data-klinikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
