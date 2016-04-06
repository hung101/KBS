<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsKejohananProgramAktiviti */

//$this->title = $model->kejohanan_program_aktiviti_id;
$this->title = GeneralLabel::laporan_aktiviti_badan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::laporan_aktiviti_badan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="ltbs-kejohanan-program-aktiviti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-kejohanan-program-aktiviti']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->kejohanan_program_aktiviti_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-kejohanan-program-aktiviti']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->kejohanan_program_aktiviti_id], [
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
            'kejohanan_program_aktiviti_id',
            'nama_kejohanana_program_aktiviti_yang_disertai',
            'tarikh_kejohanan_program_aktiviti_yang_disertai',
            'bilangan_peserta_yang_menyertai',
            'kos_kejohanan_program_aktiviti_yang_disertai',
        ],
    ]);*/ ?>

</div>
