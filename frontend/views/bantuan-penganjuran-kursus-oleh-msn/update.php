<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusOlehMsn */

$this->title = 'Update Bantuan Penganjuran Kursus Oleh Msn: ' . $model->bantuan_penganjuran_kursus_oleh_msn_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kursus Oleh Msns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kursus_oleh_msn_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kursus_oleh_msn_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kursus-oleh-msn-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
