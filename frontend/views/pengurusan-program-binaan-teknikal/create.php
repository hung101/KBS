<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanTeknikal */

$this->title = GeneralLabel::tambah.' '.GeneralLabel::teknikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-teknikal-create">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
