<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanELaporan */

$this->title = GeneralLabel::createTitle.' '.'Ref Kelulusan Elaporan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Elaporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-elaporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
