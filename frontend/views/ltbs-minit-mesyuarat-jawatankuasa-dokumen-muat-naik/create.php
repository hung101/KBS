<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik */

$this->title = GeneralLabel::tambah_muat_naik_minit_mesyuarat_jawatankuasa_menetapkan_mesyuarat_agong;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::muat_naik_minit_mesyuarat_jawatankuasa_menetapkan_mesyuarat_agong, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
