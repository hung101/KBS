<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgramPeserta */

$this->title = 'Tambah Maklumat Peserta Latihan Dan Program';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Peserta Latihan Dan Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="latihan-dan-program-peserta-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
