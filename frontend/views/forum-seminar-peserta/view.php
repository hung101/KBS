<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ForumSeminarPeserta */

$this->title = $model->forum_seminar_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Forum Seminar Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-seminar-peserta-view">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
