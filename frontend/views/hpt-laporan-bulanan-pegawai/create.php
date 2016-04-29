<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\HptLaporanBulananPegawai */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::hpt_laporan_bulanan_pegawai;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::hpt_laporan_bulanan_pegawai, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpt-laporan-bulanan-pegawai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
