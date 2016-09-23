<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPassportTempatDikeluarkan */

$this->title = 'Create Ref Passport Tempat Dikeluarkan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Passport Tempat Dikeluarkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-passport-tempat-dikeluarkan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
