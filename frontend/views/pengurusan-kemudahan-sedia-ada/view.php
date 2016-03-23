<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanSediaAda */

//$this->title = $model->pengurusan_kemudahan_sedia_ada_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_kemudahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-sedia-ada-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['update']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-sedia-ada']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kemudahan_sedia_ada_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['delete']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-sedia-ada']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kemudahan_sedia_ada_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_kemudahan_sedia_ada_id',
            'pengurusan_kemudahan_venue_id',
            'keluasan_padang',
            'jumlah_kapasiti',
            'bilangan_kekerapan_penyenggaran',
            'kekerapan_penggunaan',
            'kekerapan_kerosakan_berlaku',
            'cost_pembaikian',
        ],
    ]);*/ ?>

</div>
