<?php

namespace backend\modules\user\forms;

use yii\data\ActiveDataProvider;
use common\models\User;

class UserSearch extends User {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $user_group_id;
    public $system_group_id;
    public $create_type;
    public $start_time;
    public $end_time;
    private $time_field = 'c_reg_date';

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status', 'create_type', 'user_group_id', 'system_group_id'], 'integer'],
            [['start_time', 'end_time'], 'date']
        ];
    }

    public function search($params) {
        $query = User::find()->with(['userGroup', 'systemGroup', 'userAcount']);

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_user_name', $this->keyword],
                    ['like', 'c_mobile', $this->keyword],
                    ['like', 'c_email', $this->keyword]
                ]);
            }

            $time_search_array = self::formatSearchTime($this->time_field, $this->start_time, $this->end_time);
            if ($time_search_array) {
                foreach ($time_search_array as $where) {
                    $query->andWhere($where);
                }
            }

            if ($this->create_type) {
                $query->andWhere(['c_create_type' => $this->create_type]);
            }

            if ($this->user_group_id) {
                $query->andWhere(['c_user_group_id' => $this->user_group_id]);
            }

            if ($this->system_group_id) {
                $query->andWhere(['c_system_group_id' => $this->system_group_id]);
            }

            if ($this->status) {
                $query->andWhere(['c_status' => $this->status]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
