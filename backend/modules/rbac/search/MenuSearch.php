<?php

namespace backend\modules\rbac\search;

use yii\data\ActiveDataProvider;
use common\models\AuthMenu;

class MenuSearch extends AuthMenu {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $pid;

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            [['keyword'], 'trim'],
            [['pagesize', 'pid', 'status'], 'integer']
        ];
    }

    public function search($params) {
        $query = AuthMenu::find();

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'name', $this->keyword],
                    ['like', 'route', $this->keyword]
                ]);
            }

            if ($this->pid) {
                $query->andWhere(['pid' => $this->pid]);
            }
            
            if ($this->status) {
                $query->andWhere(['status' => $this->status]);
            }

            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
