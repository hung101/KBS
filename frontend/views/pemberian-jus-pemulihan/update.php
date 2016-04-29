<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PemberianJusPemulihan */

$this->title = 'Update Pemberian Jus Pemulihan: ' . ' ' . $model->pemberian_jus_pemulihan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pemberian Jus Pemulihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pemberian_jus_pemulihan_id, 'url' => ['view', 'id' => $model->pemberian_jus_pemulihan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pemberian-jus-pemulihan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
