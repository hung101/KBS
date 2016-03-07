<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanPemeriksa */

//$this->title = $model->pengurusan_kemudahan_aduan_pemeriksa_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Kemudahan Aduan Pemeriksa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Kemudahan Aduan Pemeriksa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-pemeriksa-pemeriksa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['update']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan-pemeriksa']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kemudahan_aduan_pemeriksa_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['delete']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan-pemeriksa']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kemudahan_aduan_pemeriksa_id], [
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
            'pengurusan_kemudahan_aduan_pemeriksa_id',
            'pengurusan_kemudahan_venue_id',
            'kategori_aduan',
            'venue',
            'peralatan',
            'tarikh_aduan',
            'nama_pengadu',
            'kenyataan_aduan',
            'tindakan_ulasan',
        ],
    ]);*/ ?>

</div>
