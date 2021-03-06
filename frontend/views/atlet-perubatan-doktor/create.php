<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanDoktor */

$this->title = GeneralLabel::createTitle . ' Doktor Peribadi';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::doktor_peribadi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-doktor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
