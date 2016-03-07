<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratAgm */

//$this->title = 'Update Ltbs Minit Mesyuarat Agm: ' . ' ' . $model->mesyuarat_agm_id;
$this->title =  'Minit Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => 'Minit Mesyuarat Agong', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->mesyuarat_agm_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ltbs-minit-mesyuarat-agm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModelSNKMA' => $searchModelSNKMA,
        'dataProviderSNKMA' => $dataProviderSNKMA,
    ]) ?>

</div>
