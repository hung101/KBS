<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefCawanganELaporan */

$this->title = GeneralLabel::createTitle.' '.'Ref Cawangan Elaporan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Cawangan Elaporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-cawangan-elaporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
