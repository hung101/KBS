<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMouMoaAntarabangsa */

//$this->title = $model->pengurusan_mou_moa_antarabangsa_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan MOU - MOA Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan MOU - MOA Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-mou-moa-antarabangsa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-mou-moa-antarabangsa']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_mou_moa_antarabangsa_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-mou-moa-antarabangsa']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_mou_moa_antarabangsa_id], [
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
            'pengurusan_mou_moa_antarabangsa_id',
            'nama_negara_terlibat',
            'agensi',
            'asas_asas_pertimbangan',
            'jangka_waktu_mula',
            'jangka_waktu_tamat',
            'status',
            'tajuk_mou_moa',
            'catatan',
        ],
    ]);*/ ?>

</div>
