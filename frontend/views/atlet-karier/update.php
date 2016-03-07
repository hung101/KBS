<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKarier */

//$this->title = 'Update Atlet Karier: ' . ' ' . $model->karier_atlet_id;
$this->title = 'Update Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Atlet Kariers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->karier_atlet_id, 'url' => ['view', 'id' => $model->karier_atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-karier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
