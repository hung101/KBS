<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspBorang11 */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bsp_borang11;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bsp_borang11, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-borang11-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
