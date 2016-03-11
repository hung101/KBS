<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUniversitiInstitusiEBiasiswa */

$this->title = 'Create Ref Universiti Institusi Ebiasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Universiti Institusi Ebiasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-universiti-institusi-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
