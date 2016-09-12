<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefCountry */

$this->title = GeneralLabel::createTitle.' Country';
$this->params['breadcrumbs'][] = ['label' => 'Country', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-country-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
