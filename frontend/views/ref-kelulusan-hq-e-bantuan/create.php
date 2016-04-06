<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanHqEBantuan */

$this->title = GeneralLabel::createTitle.' '.'Ref Kelulusan Hq Ebantuan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Hq Ebantuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-hq-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
