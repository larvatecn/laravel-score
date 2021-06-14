<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace Larva\Score\Observers;

use Larva\Score\Models\Bonus;
use Larva\Score\Models\Transaction;

class BonusObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param Bonus $bonus
     * @return void
     */
    public function creating(Bonus $bonus)
    {
        $bonus->paid = false;
    }

    /**
     * Handle the user "created" event.
     *
     * @param Bonus $bonus
     * @return void
     */
    public function created(Bonus $bonus)
    {
        $bonus->transaction()->create([
            'user_id' => $bonus->user_id,
            'type' => Transaction::TYPE_RECEIPTS_EXTRA,
            'description' => $bonus->description,
            'score' => $bonus->score,
            'current_score' => $bonus->user->score + $bonus->score
        ]);
        $bonus->updateQuietly(['paid' => true]);
    }
}