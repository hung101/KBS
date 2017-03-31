<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ForumSeminarPeserta */

$this->title = 'Update Forum Seminar Peserta: ' . $model->forum_seminar_peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Forum Seminar Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->forum_seminar_peserta_id, 'url' => ['view', 'id' => $model->forum_seminar_peserta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forum-seminar-peserta-update">
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
