<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanPendapatanTahunLepas */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebantuan_pendapatan_tahun_lepas.': ' . ' ' . $model->pendapatan_tahun_lepas_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_pendapatan_tahun_lepas, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pendapatan_tahun_lepas_id, 'url' => ['view', 'id' => $model->pendapatan_tahun_lepas_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-pendapatan-tahun-lepas-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
