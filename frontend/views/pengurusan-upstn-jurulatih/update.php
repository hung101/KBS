<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanUpstnAtlet */

$this->title = 'Update Pengurusan Upstn Atlet: ' . $model->pengurusan_upstn_atlet_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Upstn Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_upstn_atlet_id, 'url' => ['view', 'id' => $model->pengurusan_upstn_atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-upstn-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
