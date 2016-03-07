<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasa */

//$this->title = $model->mesyuarat_id;
$this->title = 'Maklumat Mesyuarat Agung Tahunan';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Mesyuarat Agung Tahunan', 'url' => Url::to(['index', 'profil_badan_sukan_id' => $profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->mesyuarat_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-jawatankuasa']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->mesyuarat_id], [
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
        'searchModelDMN' => $searchModelDMN,
        'dataProviderDMN' => $dataProviderDMN,
        'searchModelSNH' => $searchModelSNH,
        'dataProviderSNH' => $dataProviderSNH,
        'searchModelNMA' => $searchModelNMA,
        'dataProviderNMA' => $dataProviderNMA,
        'searchModelSNKMA' => $searchModelSNKMA,
        'dataProviderSNKMA' => $dataProviderSNKMA,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mesyuarat_id',
            'tarikh',
            'masa',
            'tempat',
            'mengikut_perlembagaan',
            'jumlah_ahli_yang_hadir',
        ],
    ])*/ ?>

</div>
