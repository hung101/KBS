<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanPermakanan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::perkhidmatan_permakanan.': ' . ' ' . $model->perkhidmatan_permakanan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::perkhidmatan_permakanan_without_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_permakanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::perkhidmatan_permakanan_without_sukan, 'url' => ['view', 'id' => $model->perkhidmatan_permakanan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkhidmatan-permakanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

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

</div>
