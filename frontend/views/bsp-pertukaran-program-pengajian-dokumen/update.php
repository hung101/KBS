<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajianDokumen */

//$this->title = 'Update Bsp Pertukaran Program Pengajian Dokumen: ' . ' ' . $model->bsp_pertukaran_program_pengajian_dokumen_id;
$this->title = GeneralLabel::updateTitle . ' Dokumen Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Pertukaran Program Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Dokumen Pertukaran Program Pengajian', 'url' => ['view', 'id' => $model->bsp_pertukaran_program_pengajian_dokumen_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-dokumen-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
