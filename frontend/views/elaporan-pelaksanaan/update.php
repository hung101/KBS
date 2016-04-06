<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::elaporan_pelaksanaan.': ' . ' ' . $model->elaporan_pelaksaan_id;
$this->title = GeneralLabel::updateTitle . ' E-Laporan Pelaksanaan / Program / Aktiviti';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_pelaksanaan_program_aktiviti, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' E-Laporan Pelaksanaan / Program / Aktiviti', 'url' => ['view', 'id' => $model->elaporan_pelaksaan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelGambar' => $searchModelGambar,
        'dataProviderGambar' => $dataProviderGambar,
        'searchModelObjektif' => $searchModelObjektif,
        'dataProviderObjektif' => $dataProviderObjektif,
        'searchModelKerjasama' => $searchModelKerjasama,
        'dataProviderKerjasama' => $dataProviderKerjasama,
        'searchModelKekurangan' => $searchModelKekurangan,
        'dataProviderKekurangan' => $dataProviderKekurangan,
        'searchModelKelebihan' => $searchModelKelebihan,
        'dataProviderKelebihan' => $dataProviderKelebihan,
        'readonly' => $readonly,
    ]) ?>

</div>
