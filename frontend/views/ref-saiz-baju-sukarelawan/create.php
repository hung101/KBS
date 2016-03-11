<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSaizBajuSukarelawan */

$this->title = 'Create Ref Saiz Baju Sukarelawan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Saiz Baju Sukarelawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-saiz-baju-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
