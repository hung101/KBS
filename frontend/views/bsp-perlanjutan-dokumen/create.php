<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanDokumen */

$this->title = 'Tambah Dokumen Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Pelanjutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-dokumen-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
