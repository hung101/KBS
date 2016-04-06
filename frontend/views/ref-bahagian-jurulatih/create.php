<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Bahagian Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
