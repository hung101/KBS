<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenyertaanPegawaiTeknikalDisertai */

$this->title = 'Create Bantuan Penyertaan Pegawai Teknikal Disertai';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penyertaan Pegawai Teknikal Disertais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penyertaan-pegawai-teknikal-disertai-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
