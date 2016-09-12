<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanPenyertaanPegawaiTeknikal */

$this->title = 'Update Ref Peringkat Bantuan Penyertaan Pegawai Teknikal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Bantuan Penyertaan Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-peringkat-bantuan-penyertaan-pegawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
