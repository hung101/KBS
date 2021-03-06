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
/* @var $model app\models\JurulatihKesihatan */

//$this->title = $model->jurulatih_kesihatan_id;
$this->title = GeneralLabel::viewTitle . ' '.GeneralLabel::maklumat_kesihatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_kesihatan, 'url' => ['index']];
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
<div class="jurulatih-kesihatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update']) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->jurulatih_kesihatan_id .'", "'.GeneralVariable::tabKesihatanID.'");']) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete']) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::button(GeneralLabel::delete, ['value'=>Url::to(['delete']),'class' => 'btn btn-danger','onclick' => 'deleteRecordAjax("'.Url::to(['delete']). '?id=' . $model->jurulatih_kesihatan_id .'", "'.GeneralVariable::tabKesihatanID.'", "'.GeneralMessage::confirmDelete.'");']) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKesihatanID.'");']) ?>
        <!--<?= Html::a('Update', ['update', 'id' => $model->jurulatih_kesihatan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->jurulatih_kesihatan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>-->
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelMasalah' => $searchModelMasalah,
        'dataProviderMasalah' => $dataProviderMasalah,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'jurulatih_kesihatan_id',
            'jurulatih_id',
            'tinggi',
            'berat',
            'masalah_kesihatan',
            'catatan',
            'pembedahan',
            'alahan',
            'sejarah_perubatan',
            'kecacatan',
        ],
    ]);*/ ?>

</div>
