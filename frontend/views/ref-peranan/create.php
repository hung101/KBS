<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeranan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peranan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peranan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peranan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
