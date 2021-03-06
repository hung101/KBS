<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajianDokumen */

$this->title = GeneralLabel::createTitle . ' Dokumen Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::dokumen_pertukaran_program_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-dokumen-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
