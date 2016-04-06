<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianELaporan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bahagian_elaporan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bahagian_elaporan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-elaporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
