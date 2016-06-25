<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatPegawaiTeknikal */

//$this->title = 'Update Maklumat Pegawai Teknikal: ' . $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::maklumat_pegawai_teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_pegawai_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_pegawai_teknikal, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-pegawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
