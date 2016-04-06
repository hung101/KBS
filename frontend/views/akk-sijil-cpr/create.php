<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AkkSijilCpr */

$this->title = GeneralLabel::createTitle.' '.'Akk Sijil Cpr';
$this->params['breadcrumbs'][] = ['label' => 'Akk Sijil Cprs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-sijil-cpr-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
