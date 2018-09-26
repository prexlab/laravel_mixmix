<?php

if(env('APP_ENV') == 'local' && !request()->MIXMIX_REFRESH){
    echo $slot;
    return;
}

if (preg_match_all('/<script.+?src="(.+?)[\?"]/', $slot, $jss)){

    $jsContents = [];

    $baseName = md5(json_encode($jss[1])) . '.js';
    $jsFile = storage_path('app/public/mixmix/' . $baseName);

    if(!is_file($jsFile) || request()->MIXMIX_REFRESH){

        foreach($jss[1] as $js){
            $jsContents[] = "\n\n/***** {$js} *****/\n\n";
            if(preg_match('/^http/', $js)){
                $jsContents[] = file_get_contents($js);
            }else{
                $jsContents[] = file_get_contents(public_path($js));
            }
        }

        echo "\n<!-- MIXMIX_REFRESH\n" . implode("\n", $jss[1]) . "\n-->\n";

        file_put_contents($jsFile, implode('', $jsContents));
    }

    printf('<script src="/storage/mixmix/%s?%s"></script>',
        $baseName, filemtime($jsFile));
}


if (preg_match_all('/<link.+?href="(.+?)[\?"].+?>/', $slot, $csss)){

    $cssContents = [];


    $baseName = md5(json_encode($csss[1])).'.css';
    $cssFile = storage_path('app/public/mixmix/' . $baseName);

    if(!is_file($cssFile) || request()->MIXMIX_REFRESH){

        foreach($csss[1] as $css){

            $cssContents[] = "\n\n/***** {$css} *****/\n\n";
            if(preg_match('/^http/', $css)){
                $cssContents[] = file_get_contents($css);
            }else{
                $cssContents[] = file_get_contents(public_path($css));
            }
        }

        echo "\n<!-- MIXMIX_REFRESH\n" . implode("\n", $csss[1]) . "\n-->\n";

        file_put_contents($cssFile, implode('', $cssContents));
    }

    printf('<link href="/storage/mixmix/%s?%s" rel="stylesheet" type="text/css">',
        $baseName, filemtime($cssFile));
}






