<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefParlimen */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::parlimen;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::alamat_parlimen, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-parlimen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
