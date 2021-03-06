<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBiasiswa */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan_biasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_biasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-biasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
