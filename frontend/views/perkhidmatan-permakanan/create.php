<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanPermakanan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::perkhidmatan_permakanan_without_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_permakanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkhidmatan-permakanan-create">

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
