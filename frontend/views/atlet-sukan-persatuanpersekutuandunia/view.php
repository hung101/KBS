<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
use yii\web\Session;

use app\models\RefProgramSemasaSukanAtlet;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSukanPersatuanpersekutuandunia */

//$this->title = $model->persatuan_persekutuan_dunia_id;
$this->title = GeneralLabel::viewTitle . ' Persatuan/Persekutuan Dunia';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::persatuanpersekutuan_dunia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-sukan-persatuanpersekutuandunia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        $session = new Session;
        $session->open();
        
        $template = '{view}';
        
        if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->persatuan_persekutuan_dunia_id .'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'");']) ?>
        <?php endif; ?>
        <?php if( ( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])) || 
            (isset($session['program_semasa_id']) && $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ): ?>
            <?= Html::button(GeneralLabel::delete, ['value'=>Url::to(['delete']),'class' => 'btn btn-danger','onclick' => 'deleteRecordAjax("'.Url::to(['delete']). '?id=' . $model->persatuan_persekutuan_dunia_id .'", "'.GeneralVariable::tabSukanPersatuanpersekutuanduniaID.'", "'.GeneralMessage::confirmDelete.'");']) ?>
        <?php endif; 
        $session->close();?>
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
