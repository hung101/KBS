<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukan */

//$this->title = $model->penyertaan_sukan_id;
$this->title = GeneralLabel::viewTitle . ' Penilaian Prestasi Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Prestasi Kejohanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penyertaan_sukan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penyertaan_sukan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
        'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penyertaan_sukan_id',
            'nama_sukan',
            'tempat_penginapan',
            'tempat_latihan',
            'nama_atlet',
            'nama_pegawai',
            'jawatan_pegawai',
            'nama_pengurus_sukan',
            'nama_sukarelawan',
        ],
    ]);*/ ?>

</div>
