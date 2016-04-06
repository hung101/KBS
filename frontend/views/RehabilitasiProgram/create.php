<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RehabilitasiProgram */

$this->title = GeneralLabel::tambah_rehabilitasi_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::rehabilitasi_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
