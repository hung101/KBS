<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikJadual */

$this->title = $model->maklumat_akademik_jadual_id;
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Akademik Jaduals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-jadual-view">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
