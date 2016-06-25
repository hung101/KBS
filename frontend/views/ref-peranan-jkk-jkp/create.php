<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerananJkkJkp */

$this->title = 'Create Ref Peranan Jkk Jkp';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peranan Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peranan-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
