<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanPasukanPenyelidikan */

$this->title = 'Create Ref Jawatan Pasukan Penyelidikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Pasukan Penyelidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-pasukan-penyelidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
