<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KhidmatPerubatanDanSainsSukanPegawai */

$this->title = 'Update Khidmat Perubatan Dan Sains Sukan Pegawai: ' . $model->khidmat_perubatan_dan_sains_sukan_pegawai_id;
$this->params['breadcrumbs'][] = ['label' => 'Khidmat Perubatan Dan Sains Sukan Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->khidmat_perubatan_dan_sains_sukan_pegawai_id, 'url' => ['view', 'id' => $model->khidmat_perubatan_dan_sains_sukan_pegawai_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="khidmat-perubatan-dan-sains-sukan-pegawai-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
