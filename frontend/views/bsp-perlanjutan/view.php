<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutan */

//$this->title = $model->bsp_perlanjutan_id;
$this->title = GeneralLabel::viewTitle . ' Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => 'Pelanjutan', 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_perlanjutan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_perlanjutan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspPerlanjutanSebab' => $searchModelBspPerlanjutanSebab,
        'dataProviderBspPerlanjutanSebab' => $dataProviderBspPerlanjutanSebab,
        'searchModelBspPerlanjutanDokumen' => $searchModelBspPerlanjutanDokumen,
        'dataProviderBspPerlanjutanDokumen' => $dataProviderBspPerlanjutanDokumen,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_perlanjutan_id',
            'bsp_pemohon_id',
            'tarikh',
            'tempoh_mohon_perlanjutan',
            'permohonan_pelanjutan',
        ],
    ]);*/ ?>

</div>
