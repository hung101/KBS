<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPrestasiAkademik */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_prestasi_akademik.': ' . ' ' . $model->bsp_prestasi_akademik_id;
$this->title = GeneralLabel::updateTitle . ' Prestasi Akademik';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebiasiswa, 'url' => ['permohonan-e-biasiswa/view', 'id' => $model->bsp_pemohon_id]];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::prestasi_akademik, 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Prestasi Akademik', 'url' => ['view', 'id' => $model->bsp_prestasi_akademik_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-prestasi-akademik-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
