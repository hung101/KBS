<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlSejarahPerubatan */

$this->title = 'Tambah Sejarah Perubatan';
$this->params['breadcrumbs'][] = ['label' => 'Sejarah Perubatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-sejarah-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
