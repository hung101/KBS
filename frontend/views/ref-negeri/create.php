<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNegeri */

$this->title = 'Create Ref Negeri';
$this->params['breadcrumbs'][] = ['label' => 'Ref Negeris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-negeri-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
