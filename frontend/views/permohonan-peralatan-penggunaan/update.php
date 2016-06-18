<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPeralatanPenggunaan */

$this->title = 'Update Permohonan Peralatan Penggunaan: ' . $model->permohonan_peralatan_penggunaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Peralatan Penggunaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_peralatan_penggunaan_id, 'url' => ['view', 'id' => $model->permohonan_peralatan_penggunaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-peralatan-penggunaan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
