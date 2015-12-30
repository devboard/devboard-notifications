<?php
namespace DevBoard\Notify;

use Symfony\Component\HttpFoundation\Request;

class EventFactory
{
    public function create(Request $request)
    {
        $eventType = $request->headers->get('X-GitHub-Event');
        $signature = $request->headers->get('X-Hub-Signature');
        $content   = $request->getContent();

        $event = new Event($eventType, $signature, $content);

        return $event;
    }
}
