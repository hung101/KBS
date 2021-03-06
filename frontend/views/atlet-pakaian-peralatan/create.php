<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPakaianPeralatan */

$this->title = GeneralLabel::createTitle . ' '.GeneralLabel::peralatan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peralatan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pakaian-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
