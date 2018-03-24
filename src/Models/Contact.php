<?php

declare(strict_types=1);

namespace Cortex\Contacts\Models;

use Rinvex\Tenants\Traits\Tenantable;
use Cortex\Foundation\Traits\Auditable;
use Spatie\Activitylog\Traits\LogsActivity;
use Rinvex\Contacts\Models\Contact as BaseContact;

/**
 * Cortex\Contacts\Models\Contact.
 *
 * @property int                                                                             $id
 * @property int                                                                             $entity_id
 * @property string                                                                          $entity_type
 * @property string                                                                          $source
 * @property string                                                                          $method
 * @property string                                                                          $full_name
 * @property string                                                                          $title
 * @property string                                                                          $email
 * @property string                                                                          $phone
 * @property string                                                                          $fax
 * @property string                                                                          $skype
 * @property string                                                                          $twitter
 * @property string                                                                          $facebook
 * @property string                                                                          $google_plus
 * @property string                                                                          $linkedin
 * @property string                                                                          $country_code
 * @property string                                                                          $language_code
 * @property string                                                                          $birthday
 * @property string                                                                          $gender
 * @property \Carbon\Carbon|null                                                             $created_at
 * @property \Carbon\Carbon|null                                                             $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cortex\Foundation\Models\Log[]   $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cortex\Contacts\Models\Contact[] $backRelatives
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent                              $entity
 * @property-read string                                                                     $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cortex\Contacts\Models\Contact[] $relatives
 * @property \Illuminate\Database\Eloquent\Collection|\Cortex\Tenants\Models\Tenant[]        $tenants
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact country($countryCode)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact language($languageCode)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact method($method)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact source($source)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereGooglePlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereLanguageCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereSkype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact withAllTenants($tenants, $group = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact withAnyTenants($tenants, $group = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact withTenants($tenants, $group = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact withoutAnyTenants()
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Contacts\Models\Contact withoutTenants($tenants, $group = null)
 * @mixin \Eloquent
 */
class Contact extends BaseContact
{
    use Auditable;
    use Tenantable;
    use LogsActivity;

    /**
     * Indicates whether to log only dirty attributes or all.
     *
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are logged on change.
     *
     * @var array
     */
    protected static $logFillable = true;

    /**
     * The attributes that are ignored on change.
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
