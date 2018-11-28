<?php

namespace backend\modules\rbac\search;

use yii\data\ActiveDataProvider;
use common\models\AuthItem;

class AuthItemSearch extends AuthItem {

    public $pagesize = 10;
    public $keyword;
    public $type;
    public $start_time;
    public $end_time;
    private $time_field = 'created_at';

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status'], 'integer'],
            [['start_time', 'end_time'], 'date'],
            ['type', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function search($params) {
        $query = AuthItem::find();

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['type' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'name', $this->keyword],
                    ['like', 'rule_name', $this->keyword],
                    ['like', 'rule_name', $this->description],
                ]);
            }

            $time_search_array = self::formatSearchTime($this->time_field, $this->start_time, $this->end_time);
            if ($time_search_array) {
                foreach ($time_search_array as $where) {
                    $query->andWhere($where);
                }
            }

            $query->andWhere(['type' => $this->type]);

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
