<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLainProgramJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::lain_program_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lain_program_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lain-program-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
