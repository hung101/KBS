<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefInsentifKelas */

$this->title = 'Create Ref Insentif Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Ref Insentif Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-insentif-kelas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
