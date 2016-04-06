<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKumpulan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kumpulan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kumpulan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kumpulan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
