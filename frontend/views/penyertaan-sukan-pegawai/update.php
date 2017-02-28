<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPegawai */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::penyertaan_sukan_pegawai.': ' . ' ' . $model->penyertaan_sukan_pegawai_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyertaan_sukan_pegawai, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penyertaan_sukan_pegawai_id, 'url' => ['view', 'id' => $model->penyertaan_sukan_pegawai_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penyertaan-sukan-pegawai-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
