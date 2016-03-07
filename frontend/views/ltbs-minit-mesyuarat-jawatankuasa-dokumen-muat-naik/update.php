<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik */

$this->title = 'Update Ltbs Minit Mesyuarat Jawatankuasa Dokumen Muat Naik: ' . ' ' . $model->dokumen_muat_naik_id;
$this->params['breadcrumbs'][] = ['label' => 'Ltbs Minit Mesyuarat Jawatankuasa Dokumen Muat Naiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dokumen_muat_naik_id, 'url' => ['view', 'id' => $model->dokumen_muat_naik_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
