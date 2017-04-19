<?php
use yii\helpers\Html;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriRawatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_rawatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_rawatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-rawatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
