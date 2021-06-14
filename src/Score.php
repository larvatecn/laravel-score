<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace Larva\Score;

use Larva\Score\Models\Bonus;
use Larva\Score\Models\Recharge;

/**
 * 积分快捷操作
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Score
{
    /**
     * 给某人奖励积分
     * @param int $user_id
     * @param int $score
     * @param string $description
     * @return Bonus
     */
    public static function Bonus(int $user_id, int $score, string $description): Bonus
    {
        return Bonus::create(['user_id' => $user_id, 'score' => $score, 'description' => $description]);
    }

    /**
     * 创建充值请求
     * @param int $user_id
     * @param string $channel
     * @param int $amount
     * @param string $type
     * @param string|null $clientIP
     * @return mixed
     */
    public static function recharge(int $user_id, string $channel, int $amount, string $type, string $clientIP = null): Recharge
    {
        return Recharge::create(['user_id' => $user_id, 'channel' => $channel, 'amount' => $amount, 'type' => $type, 'client_ip' => $clientIP]);
    }
}