<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalDicadangkan */

$this->title = 'Create Bantuan Penganjuran Kursus Pegawai Teknikal Dicadangkan';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Dicadangkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-penganjuran-kursus-pegawai-teknikal-dicadangkan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
