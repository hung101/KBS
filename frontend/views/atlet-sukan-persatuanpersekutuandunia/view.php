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
/* @var $model app\models\AtletSukanPersatuanpersekutuandunia */

//$this->title = $model->persatuan_persekutuan_dunia_id;
$this->title = GeneralLabel::viewTitle . ' Persatuan/Persekutuan Dunia';
$this->params['breadcrumbs'][] = ['label' => 'Persatuan/Persekutuan Dunia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-sukan-persatuanpersekutuandunia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->persatuan_persekutuan_dunia_id .'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'");']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])): ?>
            <?= Html::button(GeneralLabel::delete, ['value'=>Url::to(['delete']),'class' => 'btn btn-danger','onclick' => 'deleteRecordAjax("'.Url::to(['delete']). '?id=' . $model->persatuan_persekutuan_dunia_id .'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'", "'.GeneralMessage::confirmDelete.'");']) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'");']) ?>
        <!--<?= Html::a('Update', ['update', 'id' => $model->persatuan_persekutuan_dunia_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->persatuan_persekutuan_dunia_id], [
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
            'persatuan_persekutuan_dunia_id',
            'atlet_id',
            'jenis',
            'name_persatuan_persekutuan_dunia',
            'alamat_1',
            'no_telefon',
            'emel',
            'laman_web',
        ],
    ]);*/ ?>

</div>
