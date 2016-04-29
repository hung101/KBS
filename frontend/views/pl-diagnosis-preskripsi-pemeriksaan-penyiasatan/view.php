<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlDiagnosisPreskripsiPemeriksaanPenyiasatan */

$this->title = $model->pl_diagnosis_preskripsi_pemeriksaan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pl_diagnosis_preskripsi_pemeriksaans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-diagnosis-preskripsi-pemeriksaan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pl_diagnosis_preskripsi_pemeriksaan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pl_diagnosis_preskripsi_pemeriksaan_id], [
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
            'pl_diagnosis_preskripsi_pemeriksaan_id',
            'pl_temujanji_id',
            'jenis_diagnosis_preskripsi_pemeriksaan',
            'status_diagnosis_preskripsi_pemeriksaan',
            'catitan_ringkas',
        ],
    ]);*/ ?>

</div>
