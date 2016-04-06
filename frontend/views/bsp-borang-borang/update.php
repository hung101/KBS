<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspBorangBorang */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_borang_borang.': ' . ' ' . $model->bsp_borang_borang_id;
$this->title = GeneralLabel::muat_turun_borangborang;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_borang_borangs, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebiasiswa, 'url' => ['permohonan-e-biasiswa/view', 'id' => $model->bsp_pemohon_id]];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Muat Turun Borang-Borang', 'url' => ['view', 'id' => $model->bsp_borang_borang_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-borang-borang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspPrestasiAkademik' => $searchModelBspPrestasiAkademik,
        'dataProviderBspPrestasiAkademik' => $dataProviderBspPrestasiAkademik,
        'searchModelBspBorang10' => $searchModelBspBorang10,
        'dataProviderBspBorang10' => $dataProviderBspBorang10,
        'searchModelBspBorang11' => $searchModelBspBorang11,
        'dataProviderBspBorang11' => $dataProviderBspBorang11,
        'readonly' => $readonly,
    ]) ?>

</div>
