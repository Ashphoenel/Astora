<?php

namespace Ashphoenel\Astora\Commands;

use Illuminate\Console\Command;

class AstoraCommand extends Command
{
    public $signature = 'astora';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
