<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademik */

$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_akademik_small;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_akademik_small, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->maklumat_akademik_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->maklumat_akademik_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->maklumat_akademik_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
    </p>
	
	<?= $this->render('_form', [
        'model' => $model,
		'searchModelMaklumatAkademikJadual' => $searchModelMaklumatAkademikJadual,
		'dataProviderMaklumatAkademikJadual' => $dataProviderMaklumatAkademikJadual,
		'searchModelMaklumatAkademikSubjek' => $searchModelMaklumatAkademikSubjek,
		'dataProviderMaklumatAkademikSubjek' => $dataProviderMaklumatAkademikSubjek,
        'readonly' => $readonly,
    ]) ?>

</div>
