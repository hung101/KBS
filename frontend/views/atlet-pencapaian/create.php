<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaian */

$this->title = GeneralLabel::createTitle . ' Pencapaian';
$this->params['breadcrumbs'][] = ['label' => 'Pencapaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelRekods' => $searchModelRekods,
        'dataProviderRekods' => $dataProviderRekods,
        'readonly' => $readonly,
    ]) ?>

</div>
