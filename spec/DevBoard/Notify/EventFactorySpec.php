<?php
namespace spec\DevBoard\Notify;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;

class EventFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DevBoard\Notify\EventFactory');
    }

    public function it_will_create_event_from_request(Request $request, HeaderBag $headerBag)
    {
        $request->headers = $headerBag;

        $headerBag->get('X-GitHub-Event')->willReturn('push');
        $headerBag->get('X-Hub-Signature')->willReturn('sha1=abc123');

        $this->create($request)->shouldReturnAnInstanceOf('DevBoard\Notify\Event');
    }
}
