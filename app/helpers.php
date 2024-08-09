<?php


use App\Models\Currency;
use App\Models\Setting;
use App\Repositories\FootballerRepository;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Translation\Translator;

if (!function_exists('user')) {
    /**
     * Get current logged in user.
     *
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable
     */
    function user()
    {
        return auth('users')->user();
    }
}

if (!function_exists('footballer')) {
    /**
     * Get current logged in footballer.
     *
     * @return \App\Models\Footballer|\Illuminate\Contracts\Auth\Authenticatable
     */
    function footballer()
    {
        return auth('api')->user() ?? auth('footballers')->user();
    }
}

if (!function_exists('__t')) {
    /**
     * A different approach to the `trans` method.
     *
     * @param string $key
     * @param string $fallback
     * @param array  $replace
     *
     * @return mixed
     */
    function __t($key, $fallback, $replace = [])
    {
        /** @var Translator $translator */
        $translator = trans();

        if ($translator->has($key, null)) {
            return $translator->get($key, $replace);
        }

        return $translator->get($fallback, $replace);
    }
}

if (!function_exists('modelAction')) {
    /**
     * Get some model action by type.
     *
     * @param string      $type
     * @param string      $action
     * @param string|null $fallback
     *
     * @return string
     */
    function modelAction($type, $action, $fallback = null)
    {
        return __t(
            "models.$type.actions.$action",
            $fallback
                ? "models.$type.actions.$fallback"
                : "models.default.actions.$action"
        );
    }
}

if (!function_exists('modelName')) {
    /**
     * Get some model attribute by type.
     *
     * @param string $type
     *
     * @return string
     */
    function modelName($type)
    {
        return __t(
            'models.'.$type.'.name',
            class_basename($type)
        );
    }
}

if (!function_exists('modelAttribute')) {
    /**
     * Get some model attribute by type.
     *
     * @param string      $type
     * @param string      $field
     * @param string|null $fallback
     *
     * @return string
     */
    function modelAttribute($type, $field, $fallback = null)
    {
        return __t(
            "models.$type.attributes.$field",
            $fallback
                ? "models.$type.attributes.$fallback"
                : "models.default.attributes.$field"
        );
    }
}

if (!function_exists('globals')) {
    /**
     * Alias to the registry function.
     *
     * @param string|null $key
     * @param mixed|null  $default
     *
     * @return mixed
     */
    function globals($key = null, $default = null)
    {
        return registry($key, $default);
    }
}

if (!function_exists('registry')) {
    /**
     * Handles global variables in a controlled namespace.
     *
     * @param string|null $key
     * @param mixed|null  $default
     *
     * @return mixed
     */
    function registry($key = null, $default = null)
    {
        if (is_string($key)) {
            $key = 'registry.'.$key;
        } elseif (is_array($key)) {
            foreach ($key as $index => $value) {
                $key['registry.'.$index] = $value;
                unset($key[$index]);
            }
        } elseif (is_null($key)) {
            $key = 'registry';
        }

        return config($key, $default);
    }
}

if (!function_exists('title')) {
    /**
     * Builds page name.
     *
     * @param string $page
     * @param bool   $reverse
     * @param string $divider
     *
     * @return string
     */
    function title($page, $reverse = true, $divider = '|')
    {
        $page = [$page];

        if ($reverse) {
            array_push($page, config('app.name'));
        } else {
            array_unshift($page, config('app.name'));
        }

        return implode(' '.$divider.' ', $page);
    }
}

if (!function_exists('settings')) {
    /**
     * Handles global variables in a controlled namespace.
     *
     * @param string|array $key
     * @param mixed|null   $default
     *
     * @return mixed
     */
    function settings($key, $default = null)
    {
        // Load stored configuration
        $loadArray = [];

        if (is_string($key)) {
            $loadArray[] = $key;
        } elseif (is_array($key)) {
            $loadArray = array_keys($key);
        }

        foreach ($loadArray as $load) {
            $partials = explode('.', $load);
            $initial = data_get($partials, 0);

            if (!config()->has('settings.'.$initial)) {
                $setting = Setting::where('meta_key', $initial)
                    ->first();

                config(['settings.'.$initial => $setting ? $setting->meta_value : null]);
                config(['settings.__old.'.$initial => $setting ? $setting->meta_value : null]);
            }
        }

        // Do what it has to do
        if (is_array($key)) {
            // Organize data for storage
            foreach ($key as $index => $value) {
                $key['settings.'.$index] = $value;
                unset($key[$index]);
            }
        } elseif (is_string($key)) {
            // Prepare data for fetch
            $key = 'settings.'.$key;
        }

        return config($key, $default);
    }
}

if (!function_exists('settingsRaw')) {
    /**
     * Get raw setting from database.
     *
     * @param string $key
     *
     * @return Setting
     *
     * @throws Exception
     */
    function settingsRaw($key)
    {
        return cache()->remember('settings.'.$key, 0, function () use ($key) {
            return Setting::where('meta_key', $key)
                ->first();
        });
    }
}

if (!function_exists('sameRoutePrefix')) {
    /**
     * Check if route has the same prefix as current route.
     *
     * @param string $route
     *
     * @return bool
     */
    function sameRoutePrefix($route)
    {
        if ($route) {
            $currentRoute = request()
                ->route()
                ->getName();

            $prefix = explode('.', $route);
            unset($prefix[count($prefix) - 1]);
            $prefix = implode('.', $prefix);

            return substr($currentRoute, 0, strlen($prefix)) == $prefix;
        }

        return false;
    }
}

if (!function_exists('moneyFormat')) {
    /**
     * Converts integer to money format.
     *
     * @param int    $input
     * @param string $prefix
     *
     * @return string
     */
    function moneyFormat($input, $prefix = 'R$ ')
    {
        $currency = Currency::create($input ?? 0);

        return $prefix.number_format($currency->toFloat(), 2, ',', '.');
    }
}

if (!function_exists('phoneFormat')) {
    /**
     * Converts a string to phone format.
     *
     * @param $value
     *
     * @return string
     */
    function phoneFormat($value)
    {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value);
    }
}

if (!function_exists('documentFormat')) {
    /**
     * Converts a string to document format.
     *
     * @param $value
     *
     * @return string
     */
    function documentFormat($value)
    {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
    }
}

if (!function_exists('discountFormat')) {
    /**
     * Converts integer to discount format.
     *
     * @param int    $input
     * @param string $prefix
     *
     * @return string
     */
    function discountFormat($discount_value, $discount_type)
    {
        if ($discount_type == 'percentage') {
            $value = $discount_value / 100;

            if ($value == intval($value)) {
                return intval($value).'%';
            } else {
                return number_format($value, 2, ',', '.').'%';
            }
        } else {
            return moneyFormat($discount_value);
        }
    }
}

if (!function_exists('stripPaymentGatewayPrefix')) {
    /**
     * Remove vindi prefix from string.
     *
     * @param $code string
     *
     * @return string
     */
    function stripPaymentGatewayPrefix($code, $gateway)
    {
        if ($code) {
            if (Str::startsWith($code, config("services.$gateway.prefix"))) {
                return substr($code, strlen(config("services.$gateway.prefix")));
            }
        }

        return $code;
    }
}



if (!function_exists('lockTable')) {
    function lockTable($table, $mode = 'SHARE ROW EXCLUSIVE')
    {
        $connection = DB::connection()
            ->getName();

        if ($connection == 'mysql') {
            $sql = "LOCK TABLES {$table} WRITE";
        }

        if ($connection == 'mssql') {
            $sql = "LOCK TABLE {$table}";
        }

        if ($connection == 'pgsql') {
            $sql = "LOCK TABLE {$table} IN {$mode} MODE";
        }

        try {
            DB::unprepared($sql);
        } catch (Exception $e) {
            //do something
            dd($e);
        }
    }
}

if (!function_exists('hex2rgba')) {
    function hex2rgba($colour, $alpha = 1)
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list($r, $g, $b) = [$colour[0].$colour[1], $colour[2].$colour[3], $colour[4].$colour[5]];
        } elseif (strlen($colour) == 3) {
            list($r, $g, $b) = [$colour[0].$colour[0], $colour[1].$colour[1], $colour[2].$colour[2]];
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);

        return "rgba($r, $g, $b, $alpha)";
    }
}

if (!function_exists('capitalize')) {
    /**
     * Return a capitalized string.
     */
    function capitalize(string $name)
    {
        $name = explode(' ', mb_strtolower($name));

        foreach ($name as $key => $word) {
            if (!in_array($word, ['de', 'do', 'dos', 'da', 'das', 'e'])) {
                $name[$key] = mb_convert_case($word, MB_CASE_TITLE, 'UTF-8');
            }
        }

        return implode(' ', $name);
    }
}

if (!function_exists('insertVariables')) {
    /**
     * Insert specific variables on texts descriptions.
     *
     * @param array $values
     * @param $text
     *
     * @return string|string[]|null
     */
    function insertVariables($values, $text)
    {
        $result = $text;

        foreach ($values as $k => $v) {
            $result = str_replace('%%'.Str::upper($k).'%%', $v ?? '', $result);
        }

        return $result;
    }
}

if (!function_exists('canSection')) {
    /**
     * Verifiy if an user can view a section.
     *
     * @return bool
     */
    function canAdminSection(array $section)
    {
        foreach (data_get($section, 'items.*.policy') as $policy) {
            if ($policy && user()->can(...$policy)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('getTokenFromHeaderRequest')) {
    /*
     * Check if has a token on header
     *
     * @return null|string
     */
    function getTokenFromHeaderRequest()
    {
        return request()->bearerToken();
    }
}

if (!function_exists('clamp')) {
    /*
     * Clamp number between min and max
     */
    function clamp($number, $min, $max)
    {
        // this '+ 0' is a generic number converter :D
        return min(max($min, $number), $max) + 0;
    }
}

if (!function_exists('getSearchQuery')) {
    /**
     * Get the current request attribute q.
     *
     * @param bool $asString
     *
     * @return mixed
     */
    function getSearchQuery($asString = true)
    {
        $query = request('q');
        if (!$asString) {
            return $query;
        }
        if (!is_string($query) && is_array($query)) {
            $query = implode(' ', \Illuminate\Support\Arr::flatten($query));
        } else {
            $query = strval($query);
        }

        return $query;
    }
}

if (!function_exists('feature_active')) {
    /**
     * Check feature status.
     *
     * @param string $slug
     *
     * @return bool|null
     */
    function feature_active($slug)
    {
        return \App\Facades\FeatureTag::getFeatureStatus($slug);
    }
}

if (!function_exists('remove_emoticons')) {
    /**
     * Check feature status.
     *
     * @param string $text
     *
     * @return string
     */
    function remove_emoticons($text)
    {
        $cleanText = '';

        // Match Emoticons
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $cleanText = preg_replace($regexEmoticons, '', $text);

        // Match Miscellaneous Symbols and Pictographs
        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $cleanText = preg_replace($regexSymbols, '', $cleanText);

        // Match Transport And Map Symbols
        $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
        $cleanText = preg_replace($regexTransport, '', $cleanText);

        // Match Miscellaneous Symbols
        $regexMisc = '/[\x{2600}-\x{26FF}]/u';
        $cleanText = preg_replace($regexMisc, '', $cleanText);

        // Match Dingbats
        $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
        $cleanText = preg_replace($regexDingbats, '', $cleanText);

        return $cleanText;
    }
}

if (!function_exists('maskCard')) {
    /**
     * Mask card.
     *
     * @param string $serial
     *
     * @return string
     */
    function maskCard($serial)
    {
        return substr($serial, 0, 4) . ' ' . substr($serial, 5, 2) . '** **** ' . substr($serial, 12, 4);
    }
}

if (!function_exists('getHumanReadableSize')) {
    /**
     * Get human readable size
     *
     *
     * @return string
     */
    function getHumanReadableSize(int $sizeInBytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        if ($sizeInBytes == 0) {
            return '0 '.$units[1];
        }

        for ($i = 0; $sizeInBytes > 1024; $i++) {
            $sizeInBytes /= 1024;
        }

        return round($sizeInBytes, 2).' '.$units[$i];
    }
}
