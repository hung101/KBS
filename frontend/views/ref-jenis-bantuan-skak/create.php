<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBantuanSkak */

$this->title = 'Create Ref Jenis Bantuan Skak';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Bantuan Skaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bantuan-skak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
