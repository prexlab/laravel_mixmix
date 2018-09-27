<?php


namespace Prexlab\LaravelMixmix;

class MixMix
{

    /**
     * @param String $slot
     * @param bool $force
     * @return null|String
     */
    public static function css(String $slot, bool $force): ?String
    {
       if (preg_match_all('/<script.+?src="(.+?)[\?"]/', $slot, $jss)) {

            $jsContents = [];

            $baseName = md5(json_encode($jss[1])) . '.js';
            if (!file_exists(storage_path('app/public/mixmix'))) {
                \File::makeDirectory(storage_path('app/public/mixmix'), 0775, true);
            }
            $jsFile = storage_path('app/public/mixmix/' . $baseName);

            if (!is_file($jsFile) || $force) {

                foreach ($jss[1] as $js) {
                    $jsContents[] = "\n\n/***** {$js} *****/\n\n";
                    $jsContents[] = self::getCode($js);
                }

                file_put_contents($jsFile, implode('', $jsContents));
            }

            return sprintf('<script src="/storage/mixmix/%s?%s"></script>',
                $baseName, filemtime($jsFile));
        }

        return null;
    }

    /**
     * @param String $slot
     * @param bool $force
     * @return null|String
     */
    public static function js(String $slot, bool $force): ?String
    {
        if (preg_match_all('/<link.+?href="(.+?)[\?"].+?>/', $slot, $csss)) {

            $cssContents = [];
            if (!file_exists(storage_path('app/public/mixmix'))) {
                \File::makeDirectory(storage_path('app/public/mixmix'), 0775, true);
            }
            $baseName = md5(json_encode($csss[1])) . '.css';
            $cssFile = storage_path('app/public/mixmix/' . $baseName);

            if (!is_file($cssFile) || $force) {

                foreach ($csss[1] as $css) {

                    $cssContents[] = "\n\n/***** {$css} *****/\n\n";
                    $cssContents[] = self::getCode($css);
                }

                file_put_contents($cssFile, implode('', $cssContents));
            }

            return sprintf('<link href="/storage/mixmix/%s?%s" rel="stylesheet" type="text/css">',
                $baseName, filemtime($cssFile));
        }

        return null;
    }

    /**
     * @param String $url
     * @return String
     */
    private static function getCode(String $url): String
    {
        $parse = parse_url($url);

        if (!empty($parse['scheme'])) {

            return file_get_contents($url);

        } elseif (!empty($parse['host'])) {

            $scheme = parse_url(request()->url(), PHP_URL_SCHEME);
            return file_get_contents($scheme . ':' . $url);

        } else {

            return file_get_contents(public_path($url));
        }
    }
}