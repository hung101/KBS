<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PembayaranInsentifJurulatih */

$this->title = 'Update Pembayaran Insentif Jurulatih: ' . $model->pembayaran_pembayaran_insentif_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Insentif Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pembayaran_pembayaran_insentif_jurulatih_id, 'url' => ['view', 'id' => $model->pembayaran_pembayaran_insentif_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pembayaran-insentif-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
