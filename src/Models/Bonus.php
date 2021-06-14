<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

declare (strict_types=1);

namespace Larva\Score\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * 积分赠送模型
 * @property int $id
 * @property int $user_id
 * @property bool $paid
 * @property int $score
 * @property Model $source
 * @property string $description
 * @property string $transaction_id
 * @property array $metadata
 * @property Carbon|null $created_at
 * @property \App\Models\User $user
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Bonus extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'score_bonus';

    /**
     * 可以批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'paid', 'user_id', 'score', 'source', 'description', 'transaction_id', 'metadata'
    ];

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = [
        'created_at',
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * 为数组 / JSON 序列化准备日期。
     *
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    /**
     * Get the user that the charge belongs to.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.' . config('auth.guards.web.provider') . '.model'));
    }

    /**
     * Get the entity's transaction.
     *
     * @return MorphOne
     */
    public function transaction(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'source');
    }

    /**
     * Get the source entity that the Transaction belongs to.
     */
    public function source(): MorphTo
    {
        return $this->morphTo();
    }
}