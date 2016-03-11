<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisElaun */

$this->title = 'Create Ref Jenis Elaun';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Elauns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
