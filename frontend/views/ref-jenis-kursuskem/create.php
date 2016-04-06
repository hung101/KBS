<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKursuskem */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Kursuskem';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kursuskems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kursuskem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
