<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsSenaraiNamaHadirJawatankuasa */

$this->title = $model->senarai_nama_hadi_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ltbs_senarai_nama_hadir_jawatankuasas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-senarai-nama-hadir-jawatankuasa-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->senarai_nama_hadi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->senarai_nama_hadi_id], [
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
            'senarai_nama_hadi_id',
            'mesyuarat_id',
            'nama_penuh',
            'no_kad_pengenalan',
            'jantina',
            'kategori_keahlian',
            'kehadiran',
        ],
    ])*/ ?>

</div>
