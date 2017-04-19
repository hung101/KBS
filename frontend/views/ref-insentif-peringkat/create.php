<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefInsentifPeringkat */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-insentif-peringkat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
