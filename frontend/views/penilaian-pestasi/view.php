<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPestasi */

//$this->title = $model->penilaian_pestasi_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::penilaian_pestasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_pestasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-pestasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penilaian_pestasi_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penilaian_pestasi_id], [
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
        'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
        'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penilaian_pestasi_id',
            'atlet_id',
            'tahap_sihat',
            'pencapaian_sukan_dalam_tahun_yang_dinilai',
            'kecederaan_jika_ada',
            'laporan_kesihatan',
            'elaun_yang_diterima',
            'skim_hadiah_kemenangan_sukan',
        ],
    ])*/ ?>

</div>
