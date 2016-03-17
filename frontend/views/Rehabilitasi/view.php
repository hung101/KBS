<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Rehabilitasi */

$this->title = $model->rehabilitasi_id;
$this->params['breadcrumbs'][] = ['label' => 'Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rehabilitasi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->rehabilitasi_id], [
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
            'rehabilitasi_id',
            'pl_diagnosis_preskripsi_pemeriksaan_id',
            'tarikh',
            'kesan_klinikal',
            'masalah_yang_dikenal_pasti',
            'potensi_rehabilitasi',
            'matlamat_rehabilitasi',
        ],
    ]) ?>

</div>
