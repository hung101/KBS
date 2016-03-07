<?php

use yii\helpers\Html;


use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKaunseling */

$this->title = GeneralLabel::createTitle . ' Kaunseling';
$this->params['breadcrumbs'][] = ['label' => 'Kaunseling', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pembangunan-kaunseling-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
