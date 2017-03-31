<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ForumSeminarPeserta */

$this->title = 'Create Forum Seminar Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Forum Seminar Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-seminar-peserta-create">
    <?= $this->render('_form', [
        'model' => $model,
		'readonly' => $readonly,
    ]) ?>

</div>
