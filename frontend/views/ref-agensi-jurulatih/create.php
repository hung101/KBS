<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiJurulatih */

$this->title = 'Create Ref Agensi Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Agensi Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
