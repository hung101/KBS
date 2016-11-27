<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKemahiran */

$this->title = GeneralLabel::createTitle . ' '.GeneralLabel::kemahiran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kemahiran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pembangunan-kemahiran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
