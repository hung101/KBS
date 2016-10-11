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
/* @var $model app\models\JurulatihKursusTertinggi */

//$this->title = $model->kursus_tertinggi_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::kelayakan_kursus_tertinggi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan_kursus_tertinggi, 'url' => ['index']];
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
<div class="jurulatih-kursus-tertinggi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update']) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->kursus_tertinggi_id .'", "'.GeneralVariable::tabKelayakanKursusTertinggiID.'");']) ?>
        <?php endif; ?>
        <?php if((isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete']) && $approved == 0)  || isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])): ?>
            <?= Html::button(GeneralLabel::delete, ['value'=>Url::to(['delete']),'class' => 'btn btn-danger','onclick' => 'deleteRecordAjax("'.Url::to(['delete']). '?id=' . $model->kursus_tertinggi_id .'", "'.GeneralVariable::tabKelayakanKursusTertinggiID.'", "'.GeneralMessage::confirmDelete.'");']) ?>
        <?php endif; ?>
        <?= Html::button(GeneralLabel::backToList, ['value'=>Url::to(['index']),'class' => 'btn btn-warning', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKelayakanKursusTertinggiID.'");']) ?>
        <!--<?= Html::a('Update', ['update', 'id' => $model->kursus_tertinggi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kursus_tertinggi_id], [
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
            'kursus_tertinggi_id',
            'jurulatih_id',
            'tahun',
            'kursus',
        ],
    ]);*/ ?>

</div>
