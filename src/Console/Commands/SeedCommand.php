<?php

declare(strict_types=1);

namespace Cortex\Contacts\Console\Commands;

use Illuminate\Console\Command;
use Cortex\Fort\Traits\AbilitySeeder;
use Cortex\Fort\Traits\BaseFortSeeder;
use Illuminate\Support\Facades\Schema;

class SeedCommand extends Command
{
    use AbilitySeeder;
    use BaseFortSeeder;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:seed:contacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Default Cortex Contacts data.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->ensureExistingContactsTables()) {
            // No seed data at the moment!
        }

        if ($this->ensureExistingFortTables()) {
            $this->seedAbilities(realpath(__DIR__.'/../../../resources/data/abilities.json'));
        }
    }

    /**
     * Ensure existing contacts tables.
     *
     * @return bool
     */
    protected function ensureExistingContactsTables()
    {
        if (! $this->hasContactsTables()) {
            $this->call('cortex:migrate:contacts');
        }

        return true;
    }

    /**
     * Check if all required contacts tables exists.
     *
     * @return bool
     */
    protected function hasContactsTables()
    {
        return Schema::hasTable(config('rinvex.contacts.tables.contacts'))
               && Schema::hasTable(config('rinvex.contacts.tables.contact_relations'));
    }
}
