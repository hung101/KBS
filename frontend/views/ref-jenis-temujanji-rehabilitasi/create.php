<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisTemujanjiRehabilitasi */

$this->title = 'Create Ref Jenis Temujanji Rehabilitasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Temujanji Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-temujanji-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
