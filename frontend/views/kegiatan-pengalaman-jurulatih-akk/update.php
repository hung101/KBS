<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanPengalamanJurulatihAkk */

$this->title = 'Update Kegiatan Pengalaman Jurulatih Akk: ' . ' ' . $model->kegiatan_pengalaman_jurulatih_akk_id;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Pengalaman Jurulatih Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kegiatan_pengalaman_jurulatih_akk_id, 'url' => ['view', 'id' => $model->kegiatan_pengalaman_jurulatih_akk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kegiatan-pengalaman-jurulatih-akk-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
