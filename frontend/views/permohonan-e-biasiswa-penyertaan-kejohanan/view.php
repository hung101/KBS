<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswaPenyertaanKejohanan */

$this->title = $model->penyertaan_kejohanan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebiasiswa_penyertaan_kejohanans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-penyertaan-kejohanan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->penyertaan_kejohanan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->penyertaan_kejohanan_id], [
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
            'penyertaan_kejohanan_id',
            'permohonan_e_biasiswa_id',
            'sukan',
            'tarikh',
            'anjuran',
            'kejohanan_mewakili',
            'acara',
            'nama_kejohanan',
            'tempat',
            'pencapaian',
        ],
    ]);*/ ?>

</div>
