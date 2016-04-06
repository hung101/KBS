<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKursusTertinggi */

$this->title = GeneralLabel::createTitle . ' Kelayakan Kursus Tertinggi';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan_kursus_tertinggi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-kursus-tertinggi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
