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
/* @var $model app\models\JurulatihSukan */

$this->title = GeneralLabel::viewTitle  . ' ' . GeneralLabel::sukan_dan_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sukan_dan_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use yii\web\Session;

    $session = new Session;
    $session->open();

    $jurulatih_id = $session['jurulatih_id'];
    $jurulatihModel = null;
    
    if (($jurulatihModel = app\models\Jurulatih::findOne($jurulatih_id)) !== null) {
        $approved = $jurulatihModel->approved;
    }

    $session->close();
?>
<div class="jurulatih-sukan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <p>
        <?php if(((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update']) && Yii::$app->user->identity->peranan !=  32) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->jurulatih_sukan_id .'", "'.GeneralVariable::tabSukanJurulatihID.'");']) ?>
        <?php endif; ?>
        <?php if(((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete']) && Yii::$app->user->identity->peranan !=  32) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::button(GeneralLabel::delete, ['value'=>Url::to(['delete']),'class' => 'btn btn-danger','onclick' => 'deleteRecordAjax("'.Url::to(['delete']). '?id=' . $model->jurulatih_sukan_id .'", "'.GeneralVariable::tabSukanJurulatihID.'", "'.GeneralMessage::confirmDelete.'");']) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabSukanJurulatihID.'");']) ?>
        <!--<?= Html::a('Update', ['update', 'id' => $model->jurulatih_sukan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->jurulatih_sukan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>-->
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelAcara' => $searchModelAcara,
        'dataProviderAcara' => $dataProviderAcara,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'jurulatih_sukan_id',
            'jurulatih_id',
            'program',
            'sukan',
            'cawangan',
            'bahagian',
            'tarikh_mula_lantikan',
            'tarikh_tamat_lantikan',
            'gaji_elaun',
            'jumlah',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
