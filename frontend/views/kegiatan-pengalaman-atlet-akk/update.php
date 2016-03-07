<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanPengalamanAtletAkk */

$this->title = 'Update Kegiatan Pengalaman Atlet Akk: ' . ' ' . $model->kegiatan_pengalaman_atlet_akk_id;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Pengalaman Atlet Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kegiatan_pengalaman_atlet_akk_id, 'url' => ['view', 'id' => $model->kegiatan_pengalaman_atlet_akk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kegiatan-pengalaman-atlet-akk-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
