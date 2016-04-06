<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSubProgramPelapisJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sub_program_pelapis_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sub_program_pelapis_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-program-pelapis-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
