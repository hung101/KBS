<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanAnggaranPerbelanjaan */

$this->title = GeneralLabel::tambah_anggaran_perbelanjaan_program_aktiviti_yang_dipohon;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anggaran_perbelanjaan_program_aktiviti_yang_dipohon, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-anggaran-perbelanjaan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
