<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PeningkatanKerjayaJurulatih */

$this->title = $model->peningkatan_kerjaya_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Peningkatan Kerjaya Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peningkatan-kerjaya-jurulatih-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->peningkatan_kerjaya_jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->peningkatan_kerjaya_jurulatih_id], [
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
            'peningkatan_kerjaya_jurulatih_id',
            'nama_jurulatih',
            'cawangan',
            'sub_cawangan',
            'program_msn',
            'lain_lain_program',
            'pusat_latihan',
            'nama_sukan',
            'nama_acara',
        ],
    ]) ?>

</div>
