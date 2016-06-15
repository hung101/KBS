<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkara */

$this->title = 'Create Ref Perkara';
$this->params['breadcrumbs'][] = ['label' => 'Ref Perkaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
