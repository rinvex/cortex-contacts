<?php

declare(strict_types=1);

use Rinvex\Menus\Models\MenuItem;
use Cortex\Contacts\Models\Contact;
use Rinvex\Menus\Models\MenuGenerator;

Menu::register('adminarea.sidebar', function (MenuGenerator $menu, Contact $contact) {
    $menu->findByTitleOrAdd(trans('cortex/foundation::common.crm'), 50, 'fa fa-briefcase', [], function (MenuItem $dropdown) use ($contact) {
        $dropdown->route(['adminarea.contacts.index'], trans('cortex/contacts::common.contacts'), 10, 'fa fa-id-card-o')->ifCan('list', $contact)->activateOnRoute('adminarea.contacts');
    });
});

Menu::register('managerarea.sidebar', function (MenuGenerator $menu, Contact $contact) {
    $menu->findByTitleOrAdd(trans('cortex/foundation::common.crm'), 50, 'fa fa-briefcase', [], function (MenuItem $dropdown) use ($contact) {
        $dropdown->route(['managerarea.contacts.index'], trans('cortex/contacts::common.contacts'), 10, 'fa fa-id-card-o')->ifCan('list', $contact)->activateOnRoute('managerarea.contacts');
    });
});

Menu::register('adminarea.contacts.tabs', function (MenuGenerator $menu, Contact $contact) {
    $menu->route(['adminarea.contacts.import'], trans('cortex/contacts::common.file'))->ifCan('import', $contact)->if(Route::is('adminarea.contacts.import*'));
    $menu->route(['adminarea.contacts.import.logs'], trans('cortex/contacts::common.logs'))->ifCan('import', $contact)->if(Route::is('adminarea.contacts.import*'));
    $menu->route(['adminarea.contacts.create'], trans('cortex/contacts::common.details'))->ifCan('create', $contact)->if(Route::is('adminarea.contacts.create'));
    $menu->route(['adminarea.contacts.edit', ['contact' => $contact]], trans('cortex/contacts::common.details'))->ifCan('update', $contact)->if($contact->exists);
    $menu->route(['adminarea.contacts.logs', ['contact' => $contact]], trans('cortex/contacts::common.logs'))->ifCan('audit', $contact)->if($contact->exists);
});

Menu::register('managerarea.contacts.tabs', function (MenuGenerator $menu, Contact $contact) {
    $menu->route(['managerarea.contacts.import'], trans('cortex/contacts::common.file'))->ifCan('import', $contact)->if(Route::is('managerarea.contacts.import*'));
    $menu->route(['managerarea.contacts.import.logs'], trans('cortex/contacts::common.logs'))->ifCan('import', $contact)->if(Route::is('managerarea.contacts.import*'));
    $menu->route(['managerarea.contacts.create'], trans('cortex/contacts::common.details'))->ifCan('create', $contact)->if(Route::is('managerarea.contacts.create'));
    $menu->route(['managerarea.contacts.edit', ['contact' => $contact]], trans('cortex/contacts::common.details'))->ifCan('update', $contact)->if($contact->exists);
    $menu->route(['managerarea.contacts.logs', ['contact' => $contact]], trans('cortex/contacts::common.logs'))->ifCan('audit', $contact)->if($contact->exists);
});
