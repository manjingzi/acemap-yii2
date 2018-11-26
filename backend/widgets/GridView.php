<?php

namespace backend\widgets;

use Yii;
use yii\grid\GridView as YiiGridView;

class GridView extends YiiGridView {

    public function init() {
        parent::init();
        $this->options = ['class' => 'grid-view', 'id' => 'grid'];
        $this->layout = '{items}<div class="row"><div class="col-xs-6">{pager}</div><div class="col-xs-6"><div class="pull-right">{summary}</div></div></div>';
        $this->emptyText = Yii::t('backend-layouts', 'no-data');
        $this->summary = '{begin} - {end} ' . Yii::t('backend-layouts', 'total-records') . ' {totalCount} ' . Yii::t('backend-layouts', 'total-pages') . ' {pageCount}';
        $this->pager = ['firstPageLabel' => Yii::t('backend-layouts', 'home'), 'prevPageLabel' => Yii::t('backend-layouts', 'prev-page'), 'nextPageLabel' => Yii::t('backend-layouts', 'next-page'), 'lastPageLabel' => Yii::t('backend-layouts', 'last-page')];
        $this->tableOptions = ['class' => 'table table-striped table-bordered table-hover'];
    }

}
