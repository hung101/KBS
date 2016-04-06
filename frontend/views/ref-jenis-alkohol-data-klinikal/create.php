<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisAlkoholDataKlinikal */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Alkohol Data Klinikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Alkohol Data Klinikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-alkohol-data-klinikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
