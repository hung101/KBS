<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPertukaranProgramPengajianDokumen */

$this->title = 'Tambah Dokumen Pertukaran Program Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Pertukaran Program Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-pertukaran-program-pengajian-dokumen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
