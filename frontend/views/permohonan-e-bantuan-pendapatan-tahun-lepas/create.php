<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanPendapatanTahunLepas */

$this->title = GeneralLabel::tambah_pendapatan_tahun_lepas;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pendapatan_tahun_lepas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-pendapatan-tahun-lepas-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
