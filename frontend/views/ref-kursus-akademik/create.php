<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKursusAkademik */

$this->title = 'Create Ref Kursus Akademik';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kursus Akademiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kursus-akademik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
