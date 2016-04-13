<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SenaraiHargaPerkhidmatanUbatanPeralatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::senarai_harga_perkhidmatan_ubatan_peralatan.': ' . ' ' . $model->senarai_harga_perkhidmatan_ubatan_peralatan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::senarai_harga_perkhidmatanubatanperalatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_harga_perkhidmatanubatanperalatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::senarai_harga_perkhidmatanubatanperalatan, 'url' => ['view', 'id' => $model->senarai_harga_perkhidmatan_ubatan_peralatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senarai-harga-perkhidmatan-ubatan-peralatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
