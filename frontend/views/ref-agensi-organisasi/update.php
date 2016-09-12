<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiAntarabangsa */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::agensi.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::agensi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>  GeneralLabel::view.' ' .GeneralLabel::agensi.': ' . ' ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
