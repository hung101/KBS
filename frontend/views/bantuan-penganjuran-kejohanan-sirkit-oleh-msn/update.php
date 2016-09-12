<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKejohananSirkitOlehMsn */

$this->title = 'Update Bantuan Penganjuran Kejohanan Oleh Msn: ' . $model->bantuan_penganjuran_kejohanan_oleh_msn_id;
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Penganjuran Kejohanan Oleh Msns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bantuan_penganjuran_kejohanan_oleh_msn_id, 'url' => ['view', 'id' => $model->bantuan_penganjuran_kejohanan_oleh_msn_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bantuan-penganjuran-kejohanan-oleh-msn-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
