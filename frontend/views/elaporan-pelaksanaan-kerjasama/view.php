<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaanKerjasama */

$this->title = $model->elaporan_pelaksanaan_kerjasama_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_pelaksanaan_kerjasamas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-kerjasama-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->elaporan_pelaksanaan_kerjasama_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->elaporan_pelaksanaan_kerjasama_id], [
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
            'elaporan_pelaksanaan_kerjasama_id',
            'elaporan_pelaksaan_id',
            'nama_kerjasama',
        ],
    ]);*/ ?>

</div>
