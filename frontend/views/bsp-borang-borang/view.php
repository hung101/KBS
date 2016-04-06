<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspBorangBorang */

//$this->title = $model->bsp_borang_borang_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebiasiswa, 'url' => ['permohonan-e-biasiswa/view', 'id' => $model->bsp_pemohon_id]];
$this->title = GeneralLabel::viewTitle . ' Muat Turun Borang-Borang';
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_borang_borangs, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-borang-borang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_borang_borang_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_borang_borang_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBspPrestasiAkademik' => $searchModelBspPrestasiAkademik,
        'dataProviderBspPrestasiAkademik' => $dataProviderBspPrestasiAkademik,
        'searchModelBspBorang10' => $searchModelBspBorang10,
        'dataProviderBspBorang10' => $dataProviderBspBorang10,
        'searchModelBspBorang11' => $searchModelBspBorang11,
        'dataProviderBspBorang11' => $dataProviderBspBorang11,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_borang_borang_id',
            'bsp_pemohon_id',
            'bsp_03',
            'bsp_04',
            'bsp_05',
            'bsp_07',
            'bsp_08',
            'bsp_09',
            'bsp_12',
            'bsp_13',
            'bsp_14',

        ],
    ]);*/ ?>

</div>
