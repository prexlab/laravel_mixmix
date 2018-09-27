<?php

use Prexlab\LaravelMixmix\MixMix;

$force = request()->input(env('FORCE_MIXMIX','FORCE_MIXMIX')) ? true : false;

if (env('APP_ENV') == 'local' && !$force) {
    echo $slot;
} else {
    echo MixMix::js($slot, $force);
    echo MixMix::css($slot, $force);
}

