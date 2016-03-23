<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LatihanDanProgram */

//$this->title = $model->latihan_dan_program_id;
$this->title = GeneralLabel::latihan_dan_pendidikan_badan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::latihan_dan_pendidikan_badan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="latihan-dan-program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['latihan-dan-program']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->latihan_dan_program_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['latihan-dan-program']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->latihan_dan_program_id], [
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
        'searchModelPeserta' => $searchModelPeserta,
        'dataProviderPeserta' => $dataProviderPeserta,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'latihan_dan_program_id',
            'nama_kursus',
            'tarikh_kursus',
            'lokasi_kursus',
            'penganjuran_kursus',
            'bilangan_ahli_yang_menyertai',
        ],
    ]);*/ ?>

</div>
