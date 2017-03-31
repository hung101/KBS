<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAcara */

$this->title = $model->perancangan_program_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-acara-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->perancangan_program_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->perancangan_program_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penyertaan_sukan_acara_id',
            'penyertaan_sukan_id',
            'nama_acara',
            'tarikh_acara',
            'keputusan_acara',
            'jumlah_pingat',
            'rekod_baru',
            'catatan_rekod_baru',
        ],
    ]);*/ ?>

</div>
