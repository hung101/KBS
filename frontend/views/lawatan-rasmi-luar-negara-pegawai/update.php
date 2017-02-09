<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LawatanRasmiLuarNegaraPegawai */

$this->title = 'Update Lawatan Rasmi Luar Negara Pegawai: ' . $model->lawatan_rasmi_luar_negara_pegawai_id;
$this->params['breadcrumbs'][] = ['label' => 'Lawatan Rasmi Luar Negara Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lawatan_rasmi_luar_negara_pegawai_id, 'url' => ['view', 'id' => $model->lawatan_rasmi_luar_negara_pegawai_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lawatan-rasmi-luar-negara-pegawai-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
