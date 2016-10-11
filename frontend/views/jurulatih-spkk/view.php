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
/* @var $model app\models\JurulatihSpkk */

//$this->title = $model->jurulatih_spkk_id;
$this->title = GeneralLabel::viewTitle . ' Kelayakan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan, 'url' => ['index']];
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
<div class="jurulatih-spkk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update']) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->jurulatih_spkk_id .'", "'.GeneralVariable::tabKelayakanID.'");']) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete']) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::button(GeneralLabel::delete, ['value'=>Url::to(['delete']),'class' => 'btn btn-danger','onclick' => 'deleteRecordAjax("'.Url::to(['delete']). '?id=' . $model->jurulatih_spkk_id .'", "'.GeneralVariable::tabKelayakanID.'", "'.GeneralMessage::confirmDelete.'");']) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKelayakanID.'");']) ?>
        <!--<?= Html::a('Update', ['update', 'id' => $model->jurulatih_spkk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->jurulatih_spkk_id], [
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
            'jurulatih_spkk_id',
            'jurulatih_id',
            'jenis_spkk',
            'tahap',
            'muatnaik_sijil',
        ],
    ]);*/ ?>

</div>
