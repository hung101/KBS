<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerkhidmatanPermakanan */

//$this->title = 'Update Perkhidmatan Permakanan: ' . ' ' . $model->perkhidmatan_permakanan_id;
$this->title = GeneralLabel::updateTitle . ' Perkhidmatan Permakanan';
$this->params['breadcrumbs'][] = ['label' => 'Perkhidmatan Permakanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Perkhidmatan Permakanan', 'url' => ['view', 'id' => $model->perkhidmatan_permakanan_id]];
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
        'readonly' => $readonly,
    ]) ?>

</div>
