<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

declare (strict_types=1);

namespace Larva\Score\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Larva\Score\Models\Recharge;

/**
 * 充值成功通知
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class RechargeSucceeded extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The user.
     *
     * @var User
     */
    public $user;

    /**
     * @var Recharge
     */
    public $recharge;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param Recharge $recharge
     */
    public function __construct($user,Recharge $recharge)
    {
        $this->user= $user;
        $this->recharge = $recharge;
    }

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Score recharge succeeded'))
            ->line(Lang::get('Your recharge score is :score', ['score' => $this->recharge->transaction->score]))
            ->line(Lang::get('Thank you for choosing, we will be happy to help you in the process of your subsequent use of the service.'));
    }
}