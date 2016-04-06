<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenamaPakaian */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenama_pakaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenama_pakaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenama-pakaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
