<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKelebihan */

$this->title = $model->elaporan_pelaksanaan_kelebihan_id;
$this->params['breadcrumbs'][] = ['label' => 'Elaporan Pelaksanaan Kelebihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kelebihan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->elaporan_pelaksanaan_kelebihan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->elaporan_pelaksanaan_kelebihan_id], [
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
            'elaporan_pelaksanaan_kelebihan_id',
            'elaporan_pelaksaan_id',
            'kelebihan',
            'session_id',

        ],
    ]);*/ ?>

</div>
