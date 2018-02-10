<?php

declare(strict_types=1);

namespace Cortex\Contacts\Http\Controllers\Managerarea;

use Rinvex\Contacts\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Cortex\Foundation\DataTables\LogsDataTable;
use Cortex\Foundation\Http\Controllers\AuthorizedController;
use Cortex\Contacts\DataTables\Managerarea\ContactsDataTable;
use Cortex\Contacts\Http\Requests\Managerarea\ContactFormRequest;

class ContactsController extends AuthorizedController
{
    /**
     * {@inheritdoc}
     */
    protected $resource = 'contact';

    /**
     * List all contacts.
     *
     * @param \Cortex\Contacts\DataTables\Managerarea\ContactsDataTable $contactsDataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(ContactsDataTable $contactsDataTable)
    {
        return $contactsDataTable->with([
            'id' => 'managerarea-contacts-index-table',
            'phrase' => trans('cortex/contacts::common.contacts'),
        ])->render('cortex/tenants::managerarea.pages.datatable');
    }

    /**
     * List contact logs.
     *
     * @param \Cortex\Contacts\Models\Contact             $contact
     * @param \Cortex\Foundation\DataTables\LogsDataTable $logsDataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function logs(Contact $contact, LogsDataTable $logsDataTable)
    {
        return $logsDataTable->with([
            'resource' => $contact,
            'tabs' => 'managerarea.contacts.tabs',
            'phrase' => trans('cortex/contacts::common.contacts'),
            'id' => "managerarea-contacts-{$contact->getKey()}-logs-table",
        ])->render('cortex/tenants::managerarea.pages.datatable-logs');
    }

    /**
     * Create new contact.
     *
     * @param \Cortex\Contacts\Models\Contact $contact
     *
     * @return \Illuminate\View\View
     */
    public function create(Contact $contact)
    {
        return $this->form($contact);
    }

    /**
     * Edit given contact.
     *
     * @param \Cortex\Contacts\Models\Contact $contact
     *
     * @return \Illuminate\View\View
     */
    public function edit(Contact $contact)
    {
        return $this->form($contact);
    }

    /**
     * Show contact create/edit form.
     *
     * @param \Cortex\Contacts\Models\Contact $contact
     *
     * @return \Illuminate\View\View
     */
    protected function form(Contact $contact)
    {
        $countries = collect(countries())->map(function ($country, $code) {
            return [
                'id' => $code,
                'text' => $country['name'],
                'emoji' => $country['emoji'],
            ];
        })->values();
        $languages = collect(languages())->pluck('name', 'iso_639_1');
        $sources = app('rinvex.contacts.contact')->distinct()->get(['source'])->pluck('source', 'source')->toArray();
        $methods = app('rinvex.contacts.contact')->distinct()->get(['method'])->pluck('method', 'method')->toArray();
        $genders = ['male' => trans('cortex/contacts::common.male'), 'female' => trans('cortex/contacts::common.female')];

        return view('cortex/contacts::managerarea.pages.contact', compact('contact', 'genders', 'countries', 'languages', 'sources', 'methods'));
    }

    /**
     * Store new contact.
     *
     * @param \Cortex\Contacts\Http\Requests\Managerarea\ContactFormRequest $request
     * @param \Cortex\Contacts\Models\Contact                             $contact
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(ContactFormRequest $request, Contact $contact)
    {
        return $this->process($request, $contact);
    }

    /**
     * Update given contact.
     *
     * @param \Cortex\Contacts\Http\Requests\Managerarea\ContactFormRequest $request
     * @param \Cortex\Contacts\Models\Contact                             $contact
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(ContactFormRequest $request, Contact $contact)
    {
        return $this->process($request, $contact);
    }

    /**
     * Process stored/updated contact.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param \Cortex\Contacts\Models\Contact         $contact
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function process(FormRequest $request, Contact $contact)
    {
        // Prepare required input fields
        $data = $request->validated();

        // Save contact
        $contact->fill($data)->save();

        return intend([
            'url' => route('managerarea.contacts.index'),
            'with' => ['success' => trans('cortex/foundation::messages.resource_saved', ['resource' => 'contact', 'id' => $contact->slug])],
        ]);
    }

    /**
     * Destroy given contact.
     *
     * @param \Cortex\Contacts\Models\Contact $contact
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return intend([
            'url' => route('managerarea.contacts.index'),
            'with' => ['warning' => trans('cortex/foundation::messages.resource_deleted', ['resource' => 'contact', 'id' => $contact->slug])],
        ]);
    }
}
