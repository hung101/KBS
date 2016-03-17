<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Jurulatih */

$this->title = $model->jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update'])): ?>
            <?= Html::a('Update', ['update', 'id' => $model->jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete'])): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->jurulatih_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'jurulatih_id',
            'gambar',
            'cawangan',
            'sub_cawangan_pelapis',
            'lain_lain_program',
            'pusat_latihan',
            'nama_sukan',
            'nama_acara',
            'status_jurulatih',
            'status_permohonan',
            'status_keaktifan_jurulatih',
            'nama',
            'bangsa',
            'agama',
            'jantina',
            'warganegara',
            'tarikh_lahir',
            'tempat_lahir',
            'taraf_perkahwinan',
            'bil_tanggungan',
            'ic_no',
            'ic_no_lama',
            'ic_tentera',
            'passport_no',
            'tamat_tempoh',
            'no_visa',
            'tamat_visa_tempoh',
            'no_permit_kerja',
            'tamat_permit_tempoh',
            'alamat_rumah_1',
            'alamat_rumah_2',
            'alamat_rumah_3',
            'alamat_rumah_negeri',
            'alamat_rumah_bandar',
            'alamat_rumah_poskod',
            'alamat_surat_menyurat_1',
            'alamat_surat_menyurat_2',
            'alamat_surat_menyurat_3',
            'alamat_surat_menyurat_negeri',
            'alamat_surat_menyurat_bandar',
            'alamat_surat_menyurat_poskod',
            'no_telefon',
            'emel',
            'status',
            'sektor',
            'jawatan',
            'no_telefon_pejabat',
            'nama_majikan',
            'alamat_majikan_1',
            'alamat_majikan_2',
            'alamat_majikan_3',
            'alamat_majikan_negeri',
            'alamat_majikan_bandar',
            'alamat_majikan_poskod',
        ],
    ]) ?>

</div>
