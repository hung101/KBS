<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanEBantuan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jawatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::acara, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
