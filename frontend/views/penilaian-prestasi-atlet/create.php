<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPrestasiAtlet */

$this->title = GeneralLabel::createTitle . ' Penilaian Prestasi Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Prestasi Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-prestasi-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
