<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKursusBantuanElaun */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kursus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kursus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kursus-bantuan-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
