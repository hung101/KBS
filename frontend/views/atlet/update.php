<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Atlet */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet.': ' . ' ' . $model->atlet_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->atlet_id, 'url' => ['view', 'id' => $model->atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => false,
    ]) ?>

</div>
