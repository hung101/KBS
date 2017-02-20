<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanUrusetia */

$this->title = GeneralLabel::tambah.' '.GeneralLabel::urusetia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::urusetia, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-urusetia-create">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
