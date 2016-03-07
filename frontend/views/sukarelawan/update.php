<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Sukarelawan */

//$this->title = 'Update Sukarelawan: ' . ' ' . $model->sukarelawan_id;
$this->title = GeneralLabel::updateTitle . ' Sukarelawan';
$this->params['breadcrumbs'][] = ['label' => 'Sukarelawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Sukarelawan', 'url' => ['view', 'id' => $model->sukarelawan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sukarelawan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
