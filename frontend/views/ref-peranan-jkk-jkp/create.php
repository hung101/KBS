<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPerananJkkJkp */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peranan."JKK JKP";
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peranan."JKK JKP", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peranan-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
