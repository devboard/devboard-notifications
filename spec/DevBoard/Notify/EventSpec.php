<?php
namespace spec\DevBoard\Notify;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Notify\Event');
    }

    public function let($eventType, $signature, $content)
    {
        $this->beConstructedWith($eventType, $signature, $content);
    }
}
