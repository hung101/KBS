<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ekemudahan */

$this->title = 'e-Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'e-Kemudahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ekemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
