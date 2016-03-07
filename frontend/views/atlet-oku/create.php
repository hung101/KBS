<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\AtletOku */

$this->title = GeneralLabel::createTitle . 'OKU';
//$this->params['breadcrumbs'][] = ['label' => 'Atlet Okus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-oku-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
