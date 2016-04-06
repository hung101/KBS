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
/* @var $model app\models\AtletPenajaansokongan */

//$this->title = $model->penajaan_sokongan_id;
$this->title = GeneralLabel::penajaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_penajaansokongans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-penajaansokongan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])): ?>
            <?= Html::button(GeneralLabel::update, ['value'=>Url::to(['update']),'class' => 'btn btn-primary', 'onclick' => 'updateRenderAjax("'.Url::to(['update']). '?id=' . $model->penajaan_sokongan_id .'", "'.GeneralVariable::tabPenajaanID.'");']) ?>
        <?php endif; ?>
        <!--<?= Html::a(GeneralLabel::update, ['update', 'id' => $model->penajaan_sokongan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->penajaan_sokongan_id], [
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
            'penajaan_sokongan_id',
            'atlet_id',
            'nama_syarikat',
            'alamat',
            'emel',
            'no_telefon',
            'peribadi_yang_bertanggungjawab',
            'jenis_kontrak',
            'nilai_kontrak',
            'tahun_permulaan',
            'tahun_akhir',
            'barang_yang_penyokong',
        ],
    ]);*/ ?>

</div>
