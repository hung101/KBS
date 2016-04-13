<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\SenaraiHargaPerkhidmatanUbatanPeralatan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::senarai_harga_perkhidmatanubatanperalatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_harga_perkhidmatanubatanperalatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senarai-harga-perkhidmatan-ubatan-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
