<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanCadanganKertasKerja */

$this->title = $model->permohonan_e_bantuan_cadangan_kertas_kerja_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_cadangan_kertas_kerjas, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-cadangan-kertas-kerja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->permohonan_e_bantuan_cadangan_kertas_kerja_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->permohonan_e_bantuan_cadangan_kertas_kerja_id], [
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
            'permohonan_e_bantuan_cadangan_kertas_kerja_id',
            'permohonan_e_bantuan_id',
            'nama_cadangan_kertas_kerja',
            'muat_naik',
        ],
    ]) ?>

</div>
