<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBiasiswaAtlet */

//$this->title = $model->pengurusan_biasiswa_atlet_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Biasiswa Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Biasiswa Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-biasiswa-atlet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-biasiswa-atlet']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_biasiswa_atlet_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-biasiswa-atlet']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_biasiswa_atlet_id], [
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
            'pengurusan_biasiswa_atlet_id',
            'atlet_id',
            'tarikh_mula',
            'tarikh_akhir',
            'nama_biasiswa_sponsor',
            'jumlah_penajaan',
        ],
    ]);*/ ?>

</div>
