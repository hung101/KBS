<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanAnggaranPerbelanjaan */

$this->title = $model->anggaran_perbelanjaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebantuan Anggaran Perbelanjaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-anggaran-perbelanjaan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->anggaran_perbelanjaan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->anggaran_perbelanjaan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'anggaran_perbelanjaan_id',
            'permohonan_e_bantuan_id',
            'butir_butir_perbelanjaan',
            'jumlah_perbelanjaan',
        ],
    ]) */?>

</div>
