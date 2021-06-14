<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

declare (strict_types=1);

namespace Larva\Score\Observers;

use Larva\Score\Models\Recharge;

/**
 * 积分充值观察者
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class RechargeObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param Recharge $recharge
     * @return void
     */
    public function saving(Recharge $recharge)
    {
        if (empty($recharge->score)) {
            $recharge->score = $recharge->amount;
        }
    }

    /**
     * Handle the user "created" event.
     *
     * @param Recharge $recharge
     * @return void
     */
    public function created(Recharge $recharge)
    {
        $recharge->charge()->create([
            'user_id' => $recharge->user_id,
            'amount' => $recharge->amount,
            'channel' => $recharge->channel,
            'subject' => trans('score.score_recharge'),
            'body' => trans('score.score_recharge'),
            'client_ip' => $recharge->client_ip,
            'type' => $recharge->type,//交易类型
        ]);
    }
}
