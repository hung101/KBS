<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajian */

$this->title = 'Update Bsp Pertukaran Program Pengajian: ' . ' ' . $model->bsp_pertukaran_program_pengajian_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Pertukaran Program Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_pertukaran_program_pengajian_id, 'url' => ['view', 'id' => $model->bsp_pertukaran_program_pengajian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-pertukaran-program-pengajian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
