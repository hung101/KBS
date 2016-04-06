<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLatarbelakangKes */

$this->title = GeneralLabel::createTitle.' '.'Ref Latarbelakang Kes';
$this->params['breadcrumbs'][] = ['label' => 'Ref Latarbelakang Kes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-latarbelakang-kes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
