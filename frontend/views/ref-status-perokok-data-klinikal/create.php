<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPerokokDataKlinikal */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Perokok Data Klinikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Perokok Data Klinikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-perokok-data-klinikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
