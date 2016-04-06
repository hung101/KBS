<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\InformasiPersatuan */

$this->title = $model->informasi_persatuan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::informasi_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informasi-persatuan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->informasi_persatuan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->informasi_persatuan_id], [
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
            'informasi_persatuan_id',
            'nama_persatuan',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_tel',
            'no_faks',
            'emel',
            'laman_web',
        ],
    ]) ?>

</div>
