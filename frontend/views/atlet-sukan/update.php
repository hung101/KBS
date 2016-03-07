<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletSukan */

//$this->title = 'Update Atlet Sukan: ' . ' ' . $model->sukan_id;
$this->title = GeneralLabel::updateTitle . ' Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Sukan', 'url' => ['view', 'id' => $model->sukan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
