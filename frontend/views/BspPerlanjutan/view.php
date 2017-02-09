<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutan */

$this->title = $model->bsp_perlanjutan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Perlanjutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_perlanjutan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_perlanjutan_id], [
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
            'bsp_perlanjutan_id',
            'bsp_pemohon_id',
            'tarikh',
            'tempoh_mohon_perlanjutan',
            'permohonan_pelanjutan',
        ],
    ]) ?>

</div>
