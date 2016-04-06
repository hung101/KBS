<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBiomekanikUjian */

$this->title = GeneralLabel::createTitle.' '.'Ref Biomekanik Ujian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Biomekanik Ujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-biomekanik-ujian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
