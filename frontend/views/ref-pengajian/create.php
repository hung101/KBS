<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPengajian */

$this->title = 'Create Ref Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pengajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
