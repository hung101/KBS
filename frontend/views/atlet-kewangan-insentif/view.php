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

    $session = new Session;
    $session->open();

    $atlet_id = $session['atlet_id'];
    $atletModel = null;
    
    if (($atletModel = app\models\Atlet::findOne($atlet_id)) !== null) {
        $hantar = $atletModel->hantar;
    }

    $session->close();

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganInsentif */

//$this->title = $model->insentif_id;
$this->title = GeneralLabel::viewTitle . ' '.GeneralLabel::insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-insentif-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        $session = new Session;
        $session->open();
        
        $template = '{view}';
        
        if( ((( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])) || 
            (isset($session['program_semasa_id']) && ($session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM || $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini']))) &&  $hantar == 0) || 
                isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['kemaskini_yang_hantar'])  ): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->insentif_id .'", "'.GeneralVariable::tabKewanganInsentifID.'");']) ?>
        <?php endif; ?>
        <?php if( ((( !isset($session['program_semasa_id']) || (isset($session['program_semasa_id']) && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM && $session['program_semasa_id'] != RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])) || 
            (isset($session['program_semasa_id']) && ($session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM || $session['program_semasa_id'] == RefProgramSemasaSukanAtlet::PODIUM_PARALIMPIK) && isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini']))) &&  $hantar == 0) || 
                isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['kemaskini_yang_hantar'])  ): ?>
            <?= Html::button(GeneralLabel::delete, ['value'=>Url::to(['delete']),'class' => 'btn btn-danger','onclick' => 'deleteRecordAjax("'.Url::to(['delete']). '?id=' . $model->insentif_id .'", "'.GeneralVariable::tabKewanganInsentifID.'", "'.GeneralMessage::confirmDelete.'");']) ?>
        <?php endif; 
        $session->close();?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKewanganInsentifID.'");']) ?>
        <!--<?= Html::a('Update', ['update', 'id' => $model->insentif_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->insentif_id], [
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
            'insentif_id',
            'atlet_id',
            'tarikh',
            'jenis_insentif',
            'nilai',
            'pertandingan',
            'pencapaian',
        ],
    ]);*/ ?>

</div>
