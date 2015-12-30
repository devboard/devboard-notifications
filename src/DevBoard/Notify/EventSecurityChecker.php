<?php
namespace DevBoard\Notify;

use DevBoard\Notify\Event;

class EventSecurityChecker
{
    private $secret;

    /**
     * EventSecurityChecker constructor.
     *
     * @param $secret
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    public function check(Event $event)
    {
        list($algorithm, $signature) = explode('=', $event->getSignature());

        $payLoadHash = hash_hmac($algorithm, $event->getContent(), $this->secret);

        if ($payLoadHash === $signature) {
            return true;
        } else {
            return false;
        }
    }
}
