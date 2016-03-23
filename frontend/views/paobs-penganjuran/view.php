<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjuran */

//$this->title = $model->penganjuran_id;
$this->title = GeneralLabel::penganjuran_acara_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_acara_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="paobs-penganjuran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penganjuran_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['paobs-penganjuran']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penganjuran_id], [
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
        'readonly' => $readonly,
        'searchModelPaobsPenganjuranSumberKewangan' => $searchModelPaobsPenganjuranSumberKewangan,
        'dataProviderPaobsPenganjuranSumberKewangan' => $dataProviderPaobsPenganjuranSumberKewangan,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penganjuran_id',
            'nama_aktiviti',
            'jenis_sukan',
            'tarikh_aktiviti',
            'alamat_lokasi',
            'pemilik_lokasi',
            'bilangan_peserta',
            'negara_peserta',
            'kos_aktiviti',
            'sumber_kewangan',
            'surat_sokongan',
            'laporan_penganjuran',
        ],
    ]);*/ ?>

</div>
