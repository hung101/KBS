<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPendidikan */

//$this->title = $model->permohonan_pendidikan_id;
$this->title = GeneralLabel::viewTitle . ' Permohonan Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-pendidikan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-pendidikan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->permohonan_pendidikan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-pendidikan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->permohonan_pendidikan_id], [
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
            'permohonan_pendidikan_id',
            'atlet_id',
            'no_ic',
            'umur',
            'jantina',
            'tinggi',
            'berat',
            'alamat_rumah_1',
            'alamat_rumah_2',
            'alamat_rumah_3',
            'alamat_rumah_negeri',
            'alamat_rumah_bandar',
            'alamat_rumah_poskod',
            'no_telefon_rumah',
            'no_telefon_bimbit',
            'nama_ibu_bapa_penjaga',
            'tahap_pendidikan',
            'aliran',
            'keputusan_spm',
            'pilihan_aliran_spm',
            'sukan',
            'acara',
            'tahun_program',
            'muat_naik',
            'catatan',
            'alamat_pendidikan_1',
            'alamat_pendidikan_2',
            'alamat_pendidikan_3',
            'alamat_pendidikan_negeri',
            'alamat_pendidikan_bandar',
            'alamat_pendidikan_poskod',
            'no_tel_pendidikan',
            'no_fax_pendidikan',
            'kelulusan',
            'nama_pencadang',
            'jawatan_pencadang',
            'no_telefon_pencadang',
            'sekolah_unit_sukan_pdd_psk_pencadang',
            'nama_pengesahan',
            'jawatan_pengesahan',
            'no_telefon_pengesahan',
            'sekolah_unit_sukan_pdd_psk_pengesahan',
        ],
    ]);*/ ?>

</div>
