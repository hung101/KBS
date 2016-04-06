<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramPersatuan */

$this->title = GeneralLabel::tambah_pengurusan_program_persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
