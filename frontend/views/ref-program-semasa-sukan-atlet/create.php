<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefProgramSemasaSukanAtlet */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::program_semasa_sukan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::program_semasa_sukan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-semasa-sukan-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
