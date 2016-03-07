<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik */

$this->title = $model->dokumen_muat_naik_id;
$this->params['breadcrumbs'][] = ['label' => 'Ltbs Minit Mesyuarat Jawatankuasa Dokumen Muat Naiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dokumen_muat_naik_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dokumen_muat_naik_id], [
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
            'dokumen_muat_naik_id',
            'mesyuarat_id',
            'nama_dokumen',
            'muat_naik',
        ],
    ])*/ ?>

</div>
