<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspDokumenSokongan */

$this->title = $model->bsp_dokumen_sokongan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_dokumen_sokongans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-dokumen-sokongan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bsp_dokumen_sokongan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bsp_dokumen_sokongan_id], [
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
            'bsp_dokumen_sokongan_id',
            'bsp_pemohon_id',
            'nama_dokumen',
            'upload',
        ],
    ]) ?>

</div>
