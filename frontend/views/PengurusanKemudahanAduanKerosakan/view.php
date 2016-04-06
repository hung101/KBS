<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanKerosakan */

$this->title = $model->pengurusan_kemudahan_aduan_kerosakan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan_aduan_kerosakan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-kerosakan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_kemudahan_aduan_kerosakan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_kemudahan_aduan_kerosakan_id], [
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
            'pengurusan_kemudahan_aduan_kerosakan_id',
            'pengurusan_kemudahan_aduan_id',
            'jenis_kerosakan',
            'lokasi_kerosakan',
        ],
    ]) ?>

</div>
