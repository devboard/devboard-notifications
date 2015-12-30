<?php
namespace DevBoard\Notify;

class Event implements \JsonSerializable
{
    private $eventType;
    private $signature;
    private $content;

    /**
     * Event constructor.
     *
     * @param $eventType
     * @param $signature
     * @param $content
     */
    public function __construct($eventType, $signature, $content)
    {
        $this->eventType = $eventType;
        $this->signature = $signature;
        $this->content   = $content;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    public function jsonSerialize()
    {
        return [
            'eventType' => $this->getEventType(),
            'signature' => $this->getSignature(),
            'content'   => json_decode($this->getContent(), true),
        ];
    }
}
