<?php

declare(strict_types=1);

namespace Cortex\Contacts\Events;

use Cortex\Contacts\Models\Contact;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ContactUpdated implements ShouldBroadcast
{
    use InteractsWithSockets;
    use SerializesModels;
    use Dispatchable;

    /**
     * The name of the queue on which to place the event.
     *
     * @var string
     */
    public $broadcastQueue = 'events';

    /**
     * The model instance passed to this event.
     *
     * @var \Cortex\Contacts\Models\Contact
     */
    public Contact $model;

    /**
     * Create a new event instance.
     *
     * @param \Cortex\Contacts\Models\Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return [
            new PrivateChannel('cortex.contacts.contacts.index'),
            new PrivateChannel("cortex.contacts.contacts.{$this->model->getRouteKey()}"),
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'contact.updated';
    }
}
