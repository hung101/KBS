<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBankAkaun */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Bank Akaun';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Bank Akauns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bank-akaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
