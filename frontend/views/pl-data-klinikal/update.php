<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PlDataKlinikal */

//$this->title = 'Update Pl Data Klinikal: ' . ' ' . $model->pl_data_klinikal_id;
$this->title = GeneralLabel::updateTitle . ' Data Klinikal';
$this->params['breadcrumbs'][] = ['label' => 'Data Klinikal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Data Klinikal', 'url' => ['view', 'id' => $model->pl_data_klinikal_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-data-klinikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
