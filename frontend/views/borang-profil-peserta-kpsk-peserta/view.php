<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BorangProfilPesertaKpskPeserta */

$this->title = $model->borang_profil_peserta_kpsk_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Borang Profil Peserta Kpsk Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-profil-peserta-kpsk-peserta-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->borang_profil_peserta_kpsk_peserta_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->borang_profil_peserta_kpsk_peserta_id], [
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
            'borang_profil_peserta_kpsk_peserta_id',
            'borang_profil_peserta_kpsk_id',
            'nama',
            'no_kad_pengenalan',
            'tarikh_lahir',
            'umur',
            'jantina',
            'bangsa',
            'agama',
            'alamat_1',
            'alamat_2',
            'alamat_3',
            'alamat_negeri',
            'alamat_bandar',
            'alamat_poskod',
            'no_telefon',
            'no_telefon_bimbit',
            'emel',
            'facebook',
            'akademik',
            'pekerjaan',
            'nama_majikan',
            'keputusan',
            'objektif',
            'struktur',
            'esei',
            'jumlah',
            'catatan',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
            'kehadiran', 
        ],
    ]);*/ ?>

</div>
