<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBankAkaun */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_bank_akaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_bank_akaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bank-akaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
