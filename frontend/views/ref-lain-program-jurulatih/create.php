<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLainProgramJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Lain Program Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Lain Program Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lain-program-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
