<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanPermakanan */

//$this->title = $model->perkhidmatan_permakanan_id;
$this->title = GeneralLabel::viewTitle . ' Perkhidmatan Permakanan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_permakanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkhidmatan-permakanan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->perkhidmatan_permakanan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->perkhidmatan_permakanan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelKeputusanAnalisiTubuhBadan' => $searchModelKeputusanAnalisiTubuhBadan,
        'dataProviderKeputusanAnalisiTubuhBadan' => $dataProviderKeputusanAnalisiTubuhBadan,
        'searchModelPemberianSuplemenMakananJusRundinganPendidikan' => $searchModelPemberianSuplemenMakananJusRundinganPendidikan,
        'dataProviderPemberianSuplemenMakananJusRundinganPendidikan' => $dataProviderPemberianSuplemenMakananJusRundinganPendidikan,
        'searchModelPemberianJusPemulihan' => $searchModelPemberianJusPemulihan,
        'dataProviderPemberianJusPemulihan' => $dataProviderPemberianJusPemulihan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'perkhidmatan_permakanan_id',
            'permohonan_perkhidmatan_permakanan_id',
            'tarikh',
            'pegawai_yang_bertanggungjawab',
            'catitan_ringkas',
        ],
    ]);*/ ?>

</div>
