<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhimpunanKem */

//$this->title = $model->pengurusan_perhimpunan_kem_id;
$this->title = GeneralLabel::viewTitle . ' '.GeneralLabel::bantuan_geran_penganjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bantuan_geran_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhimpunan-kem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_perhimpunan_kem_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-perhimpunan-kem']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_perhimpunan_kem_id], [
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
        'searchModelPerhimpunanKemKos' => $searchModelPerhimpunanKemKos,
        'dataProviderPerhimpunanKemKos' => $dataProviderPerhimpunanKemKos,
        'searchModelPerhimpunanKemPeserta' => $searchModelPerhimpunanKemPeserta,
        'dataProviderPerhimpunanKemPeserta' => $dataProviderPerhimpunanKemPeserta,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_perhimpunan_kem_id',
            'nama_ppn',
            'pengurus_pn',
            'nama_penganjuran',
            'kategori_penganjuran',
            'sub_kategori_penganjuran',
            'tahap_penganjuran',
            'negeri',
            'kategori_sukan',
            'tarikh_penganjuran',
            'activiti',
            'tempat',
            'jumlah_peserta',
            'sokongan_pn',
            'kelulusan',
        ],
    ]);*/ ?>

</div>
