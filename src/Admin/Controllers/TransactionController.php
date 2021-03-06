<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace Larva\Score\Admin\Controllers;

use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Grid;
use Larva\Score\Models\Transaction;

/**
 * 积分明细
 * @author Tongle Xu <xutongle@gmail.com>
 */
class TransactionController extends AdminController
{
    /**
     * Get content title.
     *
     * @return string
     */
    protected function title(): string
    {
        return '积分明细';
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new Transaction(), function (Grid $grid) {
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('user_id', '用户ID');
                $filter->equal('type','交易类型')->select(Transaction::getAllType());
            });
            $grid->quickSearch(['id']);
            $grid->model()->orderBy('id', 'desc');

            $grid->column('id', '流水号');
            $grid->column('user_id', '用户ID');

            $grid->column('score', '交易积分');
            $grid->column('current_score', '交易后积分');
            $grid->column('description', '描述');
            $grid->column('type', '交易类型')->using(Transaction::getAllType());
            $grid->column('client_ip', '客户端IP');
            $grid->column('created_at', '创建时间')->sortable();

            $grid->disableCreateButton();
            $grid->disableViewButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();

        });
    }
}