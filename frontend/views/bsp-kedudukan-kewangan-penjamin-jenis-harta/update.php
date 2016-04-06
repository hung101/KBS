<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjaminJenisHarta */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_kedudukan_kewangan_penjamin_jenis_harta.': ' . ' ' . $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id;
$this->title = GeneralLabel::updateTitle . ' Kedudukan Kewangan Penjamin (Jenis Harta)';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kedudukan_kewangan_penjamin_jenis_harta, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Kedudukan Kewangan Penjamin (Jenis Harta)', 'url' => ['view', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
