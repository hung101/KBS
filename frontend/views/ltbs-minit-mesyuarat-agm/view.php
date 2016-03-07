<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratAgm */

//this->title = $model->mesyuarat_agm_id;
$this->title =  'Minit Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => 'Minit Mesyuarat Agong', 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="ltbs-minit-mesyuarat-agm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-agm']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->mesyuarat_agm_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-minit-mesyuarat-agm']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->mesyuarat_agm_id], [
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
        'searchModelSNKMA' => $searchModelSNKMA,
        'dataProviderSNKMA' => $dataProviderSNKMA,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mesyuarat_agm_id',
            'tarikh',
            'masa',
            'tempat',
            'jumlah_ahli_yang_hadir',
            'jumlah_ahli_yang_layak_mengundi',
            'agenda_mesyuarat',
            'keputusan_mesyuarat',
        ],
    ]);*/ ?>

</div>
