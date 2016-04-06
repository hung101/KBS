<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanFisiologi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::perkhidmatan_fisiologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perkhidmatan_fisiologi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
