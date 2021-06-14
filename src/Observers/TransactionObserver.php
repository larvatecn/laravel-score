<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

declare (strict_types=1);

namespace Larva\Score\Observers;

use Larva\Score\Exceptions\ScoreException;
use Larva\Score\Models\Transaction;

/**
 * 积分交易观察者
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class TransactionObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param Transaction $transaction
     * @return void
     * @throws ScoreException
     */
    public function created(Transaction $transaction)
    {
        $transaction->commitToDb();
    }
}