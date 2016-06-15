<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTindakanAduan */

$this->title = 'Create Ref Tindakan Aduan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tindakan Aduans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tindakan-aduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
