<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanKomplimentari */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::perkhidmatan_komplimentari;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_komplimentari, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-komplimentari-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
