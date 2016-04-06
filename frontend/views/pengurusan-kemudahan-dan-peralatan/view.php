<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanDanPeralatan */

//$this->title = $model->pengurusan_kemudahan_dan_peralatan_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Kemudahan Dan Peralatan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan_dan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-dan-peralatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kemudahan-dan-peralatan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kemudahan_dan_peralatan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pengurusan-kemudahan-dan-peralatan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kemudahan_dan_peralatan_id], [
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
            'pengurusan_kemudahan_dan_peralatan_id',
            'kerja',
            'masa',
            'catatan_ringkas',
            'tindakan_yang_diambil',
            'hasil',
            'ketidakpatuhan',
        ],
    ]);*/ ?>

</div>
