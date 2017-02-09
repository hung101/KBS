<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

$this->title = $model->bsp_bendahari_ipt_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Bendahari Ipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-bendahari-ipt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_bendahari_ipt_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_bendahari_ipt_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_bendahari_ipt_id',
            'nama_pelajar',
            'no_kad_pengenalan',
            'no_uni_matrix',
            'yuran_pengajian',
        ],
    ]) ?>

</div>
