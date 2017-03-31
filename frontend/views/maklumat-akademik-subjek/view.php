<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikSubjek */

$this->title = $model->maklumat_akademik_subjek_id;
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Akademik Subjeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-subjek-view">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
