<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsPenyataKewangan */

$this->title =  'Penyata Kewangan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyata_kewangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="ltbs-penyata-kewangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
