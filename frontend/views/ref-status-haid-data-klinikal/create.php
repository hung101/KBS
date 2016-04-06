<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusHaidDataKlinikal */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Haid Data Klinikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Haid Data Klinikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-haid-data-klinikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
