<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKejohananTemasya */

//$this->title = $model->pengurusan_kejohanan_temasya_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kejohanan Temasya', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kejohanan-temasya-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kejohanan_temasya_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kejohanan_temasya_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
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
            'pengurusan_kejohanan_temasya_id',
            'tarikh_kejohanan',
            'nama_sukan',
            'nama_acara',
            'lokasi_kejohanan',
            'nama_ketua_kontijen',
            'nama_atlet',
            'nama_pegawai',
            'nama_doktor',
            'nama_fisio',
            'tarikh_penginapan_mula',
            'tarikh_penginapan_akhir',
            'tarikh_perjalanan_pesawat',
            'tarikh_pulang_perjalanan_pesawat',
            'catatan_pesawat',
        ],
    ]);*/ ?>

</div>
