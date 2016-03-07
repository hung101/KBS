<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKewangan */

//$this->title = $model->pengurusan_kewangan_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Kewangan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kewangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kewangan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kewangan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kewangan_id], [
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
            'pengurusan_kewangan_id',
            'nama_acara_program',
            'tarikh_acara',
            'kategori_acara',
            'objektif',
            'kategori_penggunaan',
            'harga_penggunaan',
            'jumlah_bajet',
            'jumlah_penggunaan',
            'catatan',
            'bajet_keseluruhan',
            'penggunaan_keseluruhan',
            'baki',
        ],
    ]);*/ ?>

</div>
