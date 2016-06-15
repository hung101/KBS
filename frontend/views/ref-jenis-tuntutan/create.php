<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisTuntutan */

$this->title = 'Create Ref Jenis Tuntutan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Tuntutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-tuntutan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
