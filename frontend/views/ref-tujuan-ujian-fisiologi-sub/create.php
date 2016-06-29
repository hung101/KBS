<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTujuanUjianFisiologiSub */

$this->title = 'Create Ref Tujuan Ujian Fisiologi Sub';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tujuan Ujian Fisiologi Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tujuan-ujian-fisiologi-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
