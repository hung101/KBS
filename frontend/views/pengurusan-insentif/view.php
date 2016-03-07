<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentif */

//$this->title = $model->pengurusan_insentif_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Insentif';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Insentif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_insentif_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_insentif_id], [
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
            'pengurusan_insentif_id',
            'atlet_id',
            'nama_insentif',
            'kumpulan',
            'rekod_baru',
            'nama_sukan',
            'kelayakan_pingat',
            'jumlah_insentif',
            'sgar_nama_jurulatih',
            'jumlah_sgar',
            'sikap_nama_persatuan',
            'jumlah_sikap',
            'siso_tarikh_kelayakan',
            'sisi_tarikh_olimpik',
            'jumlah_siso',
            'sito_nama_acara_di_olimpik',
            'sito_pingat',
            'jumlah_sito',
            'category_insentif',
            'kelulusan',
        ],
    ])*/ ?>

</div>
