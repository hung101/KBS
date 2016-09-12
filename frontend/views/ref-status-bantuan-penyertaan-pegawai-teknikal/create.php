<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusBantuanPenyertaanPegawaiTeknikal */

$this->title = 'Create Ref Status Bantuan Penyertaan Pegawai Teknikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Bantuan Penyertaan Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-bantuan-penyertaan-pegawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
