<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefProgramSemasaSukanAtlet */

$this->title = GeneralLabel::createTitle.' '.'Ref Program Semasa Sukan Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Ref Program Semasa Sukan Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-semasa-sukan-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
