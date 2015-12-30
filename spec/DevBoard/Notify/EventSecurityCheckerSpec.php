<?php
namespace spec\DevBoard\Notify;

use DevBoard\Notify\Event;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventSecurityCheckerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Notify\EventSecurityChecker');
    }

    public function let()
    {
        $this->beConstructedWith('secret');
    }

    public function it_will_return_true_if_check_passes(Event $event)
    {
        $event->getSignature()->willReturn('sha1=5d61605c3feea9799210ddcb71307d4ba264225f');
        $event->getContent()->willReturn('{}');

        $this->check($event)->shouldReturn(true);
    }

    public function it_will_return_false_on_check_fail(Event $event)
    {
        $event->getSignature()->willReturn('sha1=abc123');
        $event->getContent()->willReturn('{}');

        $this->check($event)->shouldReturn(false);
    }
}
