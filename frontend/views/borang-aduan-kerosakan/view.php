<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKerosakan */

//$this->title = $model->borang_aduan_kerosakan_id;

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::borang_aduan_kerosakan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_aduan_kerosakan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kerosakan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kerosakan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->borang_aduan_kerosakan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['borang-aduan-kerosakan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->borang_aduan_kerosakan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?= Html::a('Cetak Borang Aduan Kerosakan &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-print"></span>', ['borang-aduan-kerosakan', 'borang_aduan_kerosakan_id' => $model->borang_aduan_kerosakan_id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBorangAduanKerosakanJenisKerosakan' => $searchModelBorangAduanKerosakanJenisKerosakan,
        'dataProviderBorangAduanKerosakanJenisKerosakan' => $dataProviderBorangAduanKerosakanJenisKerosakan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'borang_aduan_kerosakan_id',
            'penyelia',
            'jawatan',
            'tarikh',
            'venue',
            'bahagian',
            'no_tel_pejabat',
            'no_tel_bimbit',
            'kawasan',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
