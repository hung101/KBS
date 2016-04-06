<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KeputusanUjianSaringan */

$this->title = $model->keputusan_ujian_saringan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::keputusan_ujian_saringan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keputusan-ujian-saringan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->keputusan_ujian_saringan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->keputusan_ujian_saringan_id], [
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
            'keputusan_ujian_saringan_id',
            'ujian_saringan_id',
            'jenis_ujian_saringan',
            'percubaan_1',
            'percubaan_2',
            'terbaik',
        ],
    ]) ?>

</div>
