<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBadanSukanAntarabangsa */

$this->title = 'Create Ref Badan Sukan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Badan Sukan Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-badan-sukan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
