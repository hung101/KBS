<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefHubunganSkimKebajian */

$this->title = 'Create Ref Hubungan Skim Kebajian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Hubungan Skim Kebajians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-hubungan-skim-kebajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
