<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsPenyataKewangan */

//$this->title = $model->penyata_kewangan_id;
$this->title = 'Penyata Kewangan';
$this->params['breadcrumbs'][] = ['label' => 'Penyata Kewangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="ltbs-penyata-kewangan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-penyata-kewangan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penyata_kewangan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-penyata-kewangan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penyata_kewangan_id], [
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
            'penyata_kewangan_id',
            'penyata_penerimaan_dan_pembayaran',
            'penyata_pendapatan_dan_perbelanjaan',
            'kunci_kira_kira',
        ],
    ]);*/ ?>

</div>
