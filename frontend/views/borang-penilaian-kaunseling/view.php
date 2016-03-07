<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaianKaunseling */

//$this->title = $model->borang_penilaian_kaunseling_id;
$this->title = GeneralLabel::viewTitle . ' Laporan Sesi Kaunseling';
$this->params['breadcrumbs'][] = ['label' => 'Laporan Sesi Kaunseling', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penilaian-kaunseling-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penilaian-kaunseling']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->borang_penilaian_kaunseling_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-penilaian-kaunseling']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->borang_penilaian_kaunseling_id], [
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
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'borang_penilaian_kaunseling_id',
            'profil_konsultan_id',
            'diagnosis',
            'preskripsi',
            'cadangan',
            'rujukan',
            'tindakan_selanjutnya',
            'kategori_permasalahan',
            'tarikh_temujanji',
        ],
    ]);*/ ?>

</div>
