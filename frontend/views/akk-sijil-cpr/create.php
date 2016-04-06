<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AkkSijilCpr */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::akk_sijil_cpr;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akk_sijil_cpr, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-sijil-cpr-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
