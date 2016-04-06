<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatELaporan */

$this->title = GeneralLabel::createTitle.' '.'Ref Peringkat Elaporan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Elaporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-elaporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
