<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapKpsk */

$this->title = 'Create Ref Tahap Kpsk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Kpsks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-kpsk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
