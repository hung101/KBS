<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanJkkJkp */

$this->title = GeneralLabel::createTitle.' '.'Ref Jawatan Jkk Jkp';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
