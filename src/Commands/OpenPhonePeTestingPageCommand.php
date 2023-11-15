<?php

namespace Anburocky3\PhonepeLaravel\Commands;

use Illuminate\Console\Command;

class OpenPhonePeTestingPageCommand extends Command
{
    protected $signature = 'phonepe:test';

    protected $description = 'Command description';

    public function handle()
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
