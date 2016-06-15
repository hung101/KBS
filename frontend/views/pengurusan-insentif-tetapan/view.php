<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentifTetapan */

//$this->title = $model->pengurusan_insentif_tetapan_id;

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_insentif_tetapan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_insentif_tetapan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-tetapan-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif-tetapan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_insentif_tetapan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-insentif-tetapan']['delete'])): ?>
            <!--<?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_insentif_tetapan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>-->
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanInsentifTetapanShakamShakar' => $searchModelPengurusanInsentifTetapanShakamShakar,
        'dataProviderPengurusanInsentifTetapanShakamShakar' => $dataProviderPengurusanInsentifTetapanShakamShakar,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_insentif_tetapan_id',
            'sgar',
            'sikap',
            'siso_olimpik',
            'siso_paralimpik',
            'sito_emas',
            'sito_perak',
            'sito_gangsa',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
