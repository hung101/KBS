<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajianSebab */

//$this->title = 'Update Bsp Pertukaran Program Pengajian Sebab: ' . ' ' . $model->bsp_pertukaran_program_pengajian_sebab_id;
$this->title = GeneralLabel::updateTitle . ' Sebab Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Sebab Pertukaran Program Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Sebab Pertukaran Program Pengajian', 'url' => ['view', 'id' => $model->bsp_pertukaran_program_pengajian_sebab_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-sebab-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
