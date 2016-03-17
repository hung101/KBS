<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanPencegahan */

$this->title = $model->program_pendidikan_pencegahan_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Program Pendidikan Pencegahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-pencegahan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->program_pendidikan_pencegahan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->program_pendidikan_pencegahan_id], [
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
            'program_pendidikan_pencegahan_id',
            'atlet_id_staff_id',
            'program',
            'tarikh_permohonan',
            'status_permohonan',
            'kategori_permohonan',
            'catitan_ringkas',
            'kelulusan',
        ],
    ]) ?>

</div>
