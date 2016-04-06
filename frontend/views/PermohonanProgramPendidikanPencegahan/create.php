<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanProgramPendidikanPencegahan */

$this->title = GeneralLabel::tambah_permohonan_program_pendidikan_pencegahan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_program_pendidikan_pencegahan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-program-pendidikan-pencegahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
