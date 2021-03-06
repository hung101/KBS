<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianJurulatih */

$this->title = $model->pengurusan_penilaian_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penilaian_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-jurulatih-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_penilaian_jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_penilaian_jurulatih_id], [
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
            'pengurusan_penilaian_jurulatih_id',
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id',
            'penilaian_oleh',
            'nama',
            'tarikh_dinilai',
        ],
    ]) ?>

</div>
