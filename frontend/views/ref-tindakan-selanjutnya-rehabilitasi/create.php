<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTindakanSelanjutnyaRehabilitasi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tindakan_selanjutnya_rehabilitasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tindakan_selanjutnya_rehabilitasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tindakan-selanjutnya-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
