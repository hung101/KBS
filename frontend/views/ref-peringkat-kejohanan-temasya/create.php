<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatKejohananTemasya */

$this->title = GeneralLabel::createTitle.' '.'Ref Peringkat Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Kejohanan Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-kejohanan-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
