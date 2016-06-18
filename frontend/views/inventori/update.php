<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Inventori */

//$this->title = 'Update Inventori: ' . $model->inventori_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::inventori;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::inventori, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::inventori, 'url' => ['view', 'id' => $model->inventori_id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="inventori-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
        'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
        'readonly' => $readonly,
    ]) ?>

</div>
