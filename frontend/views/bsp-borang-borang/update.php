<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspBorangBorang */

//$this->title = 'Update Bsp Borang Borang: ' . ' ' . $model->bsp_borang_borang_id;
$this->title = 'Muat Turun Borang-Borang';
//$this->params['breadcrumbs'][] = ['label' => 'Bsp Borang Borangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Permohonan e-Biasiswa', 'url' => ['permohonan-e-biasiswa/view', 'id' => $model->bsp_pemohon_id]];
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
