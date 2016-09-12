<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusBantuanPenganjuranKursusPegawaiTeknikal */

$this->title = 'Create Ref Status Bantuan Penganjuran Kursus Pegawai Teknikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Bantuan Penganjuran Kursus Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-bantuan-penganjuran-kursus-pegawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
