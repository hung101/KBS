<?php
use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefAcara */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pencalonan_pasukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pencalonan_pasukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pencalonan-pasukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
