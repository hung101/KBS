<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKarier */

//$this->title = $model->karier_atlet_id;
$this->title = 'Karrier';
$this->params['breadcrumbs'][] = ['label' => 'Atlet Kariers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-karier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->karier_atlet_id .'", "'.GeneralVariable::tabKarrierID.'");']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])): ?>
            <?= Html::button(GeneralLabel::delete, ['value'=>Url::to(['delete']),'class' => 'btn btn-danger','onclick' => 'deleteRecordAjax("'.Url::to(['delete']). '?id=' . $model->karier_atlet_id .'", "'.GeneralVariable::tabKarrierID.'", "'.GeneralMessage::confirmDelete.'");']) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKarrierID.'");']) ?>
        <!--<?= Html::a('Update', ['update', 'id' => $model->karier_atlet_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->karier_atlet_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>-->
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'karier_atlet_id',
            'atlet_id',
            'syarikat',
            'alamat',
            'laman_web',
            'tel_no',
            'emel',
            'jawatan_kerja',
            'pendapatan',
            'tahun_mula',
            'tahun_tamat',
            'socso_no',
            'kwsp_no',
            'income_tax_no',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ])*/ ?>

</div>
