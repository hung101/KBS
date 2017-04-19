<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\RefPenganjurJkk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::penganjur." JKK";
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjur." JKK", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penganjur-jkk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
