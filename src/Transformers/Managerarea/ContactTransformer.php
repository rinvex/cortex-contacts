<?php

declare(strict_types=1);

namespace Cortex\Contacts\Transformers\Managerarea;

use Rinvex\Support\Traits\Escaper;
use Cortex\Contacts\Models\Contact;
use League\Fractal\TransformerAbstract;

class ContactTransformer extends TransformerAbstract
{
    use Escaper;

    /**
     * @return array
     */
    public function transform(Contact $contact): array
    {
        $country = $contact->country_code ? country($contact->country_code) : null;
        $language = $contact->language_code ? language($contact->language_code) : null;

        return $this->escape([
            'id' => (string) $contact->getRouteKey(),
            'full_name' => (string) $contact->full_name,
            'email' => (string) $contact->email,
            'phone' => (string) $contact->phone,
            'country_code' => (string) optional($country)->getName(),
            'country_emoji' => (string) optional($country)->getEmoji(),
            'language_code' => (string) optional($language)->getName(),
            'source' => (string) $contact->source,
            'method' => (bool) $contact->method,
            'created_at' => (string) $contact->created_at,
            'updated_at' => (string) $contact->updated_at,
        ]);
    }
}