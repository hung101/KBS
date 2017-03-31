<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikSubjek */

$this->title = 'Create Maklumat Akademik Subjek';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Akademik Subjeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-subjek-create">
    <?= $this->render('_form', [
        'model' => $model,
		'readonly' => $readonly,
    ]) ?>

</div>
