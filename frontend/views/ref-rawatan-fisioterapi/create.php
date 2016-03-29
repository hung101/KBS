<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRawatanFisioterapi */

$this->title = 'Create Ref Rawatan Fisioterapi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Rawatan Fisioterapis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rawatan-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
