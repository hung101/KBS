<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanInduk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jawatan_induk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jawatan_induk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-induk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
