<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik */

$this->title = 'Tambah Muat Naik Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => 'Muat Naik Minit Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
