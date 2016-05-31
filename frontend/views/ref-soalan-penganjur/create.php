<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPenganjur */

$this->title = 'Create Ref Soalan Penganjur';
$this->params['breadcrumbs'][] = ['label' => 'Ref Soalan Penganjurs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-soalan-penganjur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
