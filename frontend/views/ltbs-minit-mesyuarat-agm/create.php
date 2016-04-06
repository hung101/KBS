<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratAgm */

$this->title =  'Minit Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::minit_mesyuarat_agong, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="ltbs-minit-mesyuarat-agm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModelSNKMA' => $searchModelSNKMA,
        'dataProviderSNKMA' => $dataProviderSNKMA,
    ]) ?>

</div>
