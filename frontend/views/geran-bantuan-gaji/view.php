<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\GeranBantuanGaji */

//$this->title = $model->geran_bantuan_gaji_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::geran_bantuan_gaji;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::geran_bantuan_gaji, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geran-bantuan-gaji-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->geran_bantuan_gaji_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['delete'])): ?>
            <?php /*echo Html::a(GeneralLabel::delete, ['delete', 'id' => $model->geran_bantuan_gaji_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]);*/ ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['update'])): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->geran_bantuan_gaji_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
		'searchModelGeranBantuanGajiLampiran' => $searchModelGeranBantuanGajiLampiran,
		'dataProviderGeranBantuanGajiLampiran' => $dataProviderGeranBantuanGajiLampiran,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'geran_bantuan_gaji_id',
            'muatnaik_gambar',
            'nama_jurulatih',
            'cawangan',
            'sub_cawangan',
            'program_msn',
            'lain_lain_program',
            'pusat_latihan',
            'nama_sukan',
            'nama_acara',
            'status_jurulatih',
            'status_permohonan',
            'status_keaktifan_jurulatih',
            'kategori_geran',
            'jumlah_geran',
            'status_geran',
            'kelulusan',
            'catatan',
        ],
    ]);*/ ?>

</div>
