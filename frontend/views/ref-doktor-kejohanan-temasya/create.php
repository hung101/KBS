<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDoktorKejohananTemasya */

$this->title = GeneralLabel::createTitle.' '.'Ref Doktor Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => 'Ref Doktor Kejohanan Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-doktor-kejohanan-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
