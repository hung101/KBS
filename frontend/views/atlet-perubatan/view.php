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
/* @var $model app\models\AtletPerubatan */

//$this->title = $model->perubatan_id;
$this->title = GeneralLabel::perubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_perubatans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->perubatan_id .'", "'.GeneralVariable::tabPerubatanID.'");']) ?>
        <?php endif; ?>
        <!--<?= Html::a(GeneralLabel::update, ['update', 'id' => $model->perubatan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->perubatan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
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
            'perubatan_id',
            'atlet_id',
            'kumpulan_darah',
            'alergi_makanan',
            'alergi_perubatan',
            'alergi_jenis_lain',
            'penyakit_semula_jadi',
        ],
    ])*/ ?>

</div>
