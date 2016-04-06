<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKejohananDiwakili */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kejohanan_diwakili;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kejohanan_diwakili, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kejohanan-diwakili-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
