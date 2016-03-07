<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CadanganElaun */

$this->title = $model->cadangan_elaun_id;
$this->params['breadcrumbs'][] = ['label' => 'Cadangan Elauns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadangan-elaun-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cadangan_elaun_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cadangan_elaun_id], [
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
            'cadangan_elaun_id',
            'atlet',
            'elaun_semasa',
            'elaun_cadangan',
            'tarikh_mula',
            'tarikh_tamat',
            'ulasan',
            'jenis_kelulusan',
            'muat_naik',
        ],
    ]) ?>

</div>
