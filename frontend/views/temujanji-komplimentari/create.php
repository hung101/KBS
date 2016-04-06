<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\TemujanjiKomplimentari */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::temujanji_komplimentori;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::temujanji_komplimentori, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temujanji-komplimentari-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
