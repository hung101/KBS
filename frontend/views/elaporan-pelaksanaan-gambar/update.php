<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanGambar */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::elaporan_pelaksanaan_gambar.': ' . ' ' . $model->elaporan_pelaksanaan_gambar_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_pelaksanaan_gambars, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_pelaksanaan_gambar_id, 'url' => ['view', 'id' => $model->elaporan_pelaksanaan_gambar_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-pelaksanaan-gambar-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
