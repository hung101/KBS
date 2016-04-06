<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgramPeserta */

$this->title = GeneralLabel::tambah_maklumat_peserta_latihan_dan_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_peserta_latihan_dan_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="latihan-dan-program-peserta-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
