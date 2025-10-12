<?php

use App\Models\AppSetting;
use App\Models\Setting;

function appSettingData($type = 'get')
{
    if (Session::get('setting_data') == '') {
        $type = 'set';
    }
    switch ($type) {
        case 'set':
            $settings = AppSetting::first();
            Session::put('setting_data', $settings);
            break;
        default:
            break;
    }
    return Session::get('setting_data');
}

function getSingleMedia($model, $collection = 'image_icon', $skip = true)
{
    if (!Auth::check() && $skip) {
        return asset('images/avatars/01.png');
    }
    if ($model !== null) {
        $media = $model->getFirstMedia($collection);
    }
    $imgurl = isset($media) ? $media->getPath() : '';
    if (file_exists($imgurl)) {
        return $media->getFullUrl();
    } else {
        switch ($collection) {
            case 'image_icon':
                $media = asset('images/avatars/01.png');
                break;
            case 'profile_image':
                $media = asset('images/avatars/01.png');
                break;
            case 'site_favicon':
                $media = asset('images/favicon.ico');
                break;
            case 'site_logo':
                $media = asset('images/logo.png');
                break;
            case 'site_dark_logo':
                $media = asset('images/dark_logo.png');
                break;
            case 'site_mini_logo':
                $media = asset('images/site_mini_logo.png');
                break;
            case 'site_dark_mini_logo':
                $media = asset('images/site_dark_mini_logo.png');
                break;
            default:
                $media = asset('images/default.png');
                break;
        }
        return $media;
    }
}

function mighty_language_direction()
{
    return 'ltr'; // Default to left-to-right
}

function json_custom_response($response, $status_code = 200)
{
    return response()->json($response, $status_code);
}

function json_pagination_response($items)
{
    return [
        'total_items' => $items->total(),
        'per_page' => $items->perPage(),
        'currentPage' => $items->currentPage(),
        'totalPages' => $items->lastPage()
    ];
}

function SettingData($type, $key = null)
{
    $setting = Setting::where('type', $type);

    $setting->when($key != null, function ($q) use ($key) {
        return $q->where('key', $key);
    });

    $setting_data = $setting->pluck('value')->first();
    return $setting_data;
}

function activeRoute($route, $isClass = false): string
{
    $requestUrl = request()->fullUrl() === $route ? true : false;

    if ($isClass) {
        return $requestUrl ? $isClass : '';
    } else {
        return $requestUrl ? 'active' : '';
    }
}

function checkMenuRoleAndPermission($menu)
{
    if (auth()->check()) {
        if ($menu->data('role') == null && auth()->user()->hasRole('admin')) {
            return true;
        }

        if ($menu->data('permission') == null && $menu->data('role') == null) {
            return true;
        }

        if ($menu->data('role') != null) {
            if (auth()->user()->hasAnyRole(explode(',', $menu->data('role')))) {
                return true;
            }
        }

        if ($menu->data('permission') != null) {
            if (is_array($menu->data('permission'))) {
                foreach ($menu->data('permission') as $permission) {
                    if (auth()->user()->can($permission)) {
                        return true;
                    }
                }
            } else {
                if (auth()->user()->can($menu->data('permission'))) {
                    return true;
                }
            }
        }
    }
    return false;
}

function languagesArray($ids = [])
{
    $language = [
        ['title' => 'Abkhaz', 'id' => 'ab'],
        ['title' => 'Afar', 'id' => 'aa'],
        ['title' => 'Afrikaans', 'id' => 'af'],
        ['title' => 'Akan', 'id' => 'ak'],
        ['title' => 'Albanian', 'id' => 'sq'],
        ['title' => 'Amharic', 'id' => 'am'],
        ['title' => 'Arabic', 'id' => 'ar'],
        ['title' => 'Aragonese', 'id' => 'an'],
        ['title' => 'Armenian', 'id' => 'hy'],
        ['title' => 'Assamese', 'id' => 'as'],
        ['title' => 'Avaric', 'id' => 'av'],
        ['title' => 'Avestan', 'id' => 'ae'],
        ['title' => 'Aymara', 'id' => 'ay'],
        ['title' => 'Azerbaijani', 'id' => 'az'],
        ['title' => 'Bambara', 'id' => 'bm'],
        ['title' => 'Bashkir', 'id' => 'ba'],
        ['title' => 'Basque', 'id' => 'eu'],
        ['title' => 'Belarusian', 'id' => 'be'],
        ['title' => 'Bengali', 'id' => 'bn'],
        ['title' => 'Bihari', 'id' => 'bh'],
        ['title' => 'Bislama', 'id' => 'bi'],
        ['title' => 'Bosnian', 'id' => 'bs'],
        ['title' => 'Breton', 'id' => 'br'],
        ['title' => 'Bulgarian', 'id' => 'bg'],
        ['title' => 'Burmese', 'id' => 'my'],
        ['title' => 'Catalan; Valencian', 'id' => 'ca'],
        ['title' => 'Chamorro', 'id' => 'ch'],
        ['title' => 'Chechen', 'id' => 'ce'],
        ['title' => 'Chichewa; Chewa; Nyanja', 'id' => 'ny'],
        ['title' => 'Chinese', 'id' => 'zh'],
        ['title' => 'Chuvash', 'id' => 'cv'],
        ['title' => 'Cornish', 'id' => 'kw'],
        ['title' => 'Corsican', 'id' => 'co'],
        ['title' => 'Cree', 'id' => 'cr'],
        ['title' => 'Croatian', 'id' => 'hr'],
        ['title' => 'Czech', 'id' => 'cs'],
        ['title' => 'Danish', 'id' => 'da'],
        ['title' => 'Divehi; Dhivehi; Maldivian;', 'id' => 'dv'],
        ['title' => 'Dutch', 'id' => 'nl'],
        ['title' => 'English', 'id' => 'en'],
        ['title' => 'Esperanto', 'id' => 'eo'],
        ['title' => 'Estonian', 'id' => 'et'],
        ['title' => 'Ewe', 'id' => 'ee'],
        ['title' => 'Faroese', 'id' => 'fo'],
        ['title' => 'Fijian', 'id' => 'fj'],
        ['title' => 'Finnish', 'id' => 'fi'],
        ['title' => 'French', 'id' => 'fr'],
        ['title' => 'Fula; Fulah; Pulaar; Pular', 'id' => 'ff'],
        ['title' => 'Galician', 'id' => 'gl'],
        ['title' => 'Georgian', 'id' => 'ka'],
        ['title' => 'German', 'id' => 'de'],
        ['title' => 'Greek, Modern', 'id' => 'el'],
        ['title' => 'Guaraní', 'id' => 'gn'],
        ['title' => 'Gujarati', 'id' => 'gu'],
        ['title' => 'Haitian; Haitian Creole', 'id' => 'ht'],
        ['title' => 'Hausa', 'id' => 'ha'],
        ['title' => 'Hebrew (modern)', 'id' => 'he'],
        ['title' => 'Herero', 'id' => 'hz'],
        ['title' => 'Hindi', 'id' => 'hi'],
        ['title' => 'Hiri Motu', 'id' => 'ho'],
        ['title' => 'Hungarian', 'id' => 'hu'],
        ['title' => 'Interlingua', 'id' => 'ia'],
        ['title' => 'Indonesian', 'id' => 'id'],
        ['title' => 'Interlingue', 'id' => 'ie'],
        ['title' => 'Irish', 'id' => 'ga'],
        ['title' => 'Igbo', 'id' => 'ig'],
        ['title' => 'Inupiaq', 'id' => 'ik'],
        ['title' => 'Ido', 'id' => 'io'],
        ['title' => 'Icelandic', 'id' => 'is'],
        ['title' => 'Italian', 'id' => 'it'],
        ['title' => 'Inuktitut', 'id' => 'iu'],
        ['title' => 'Japanese', 'id' => 'ja'],
        ['title' => 'Javanese', 'id' => 'jv'],
        ['title' => 'Kalaallisut, Greenlandic', 'id' => 'kl'],
        ['title' => 'Kannada', 'id' => 'kn'],
        ['title' => 'Kanuri', 'id' => 'kr'],
        ['title' => 'Kashmiri', 'id' => 'ks'],
        ['title' => 'Kazakh', 'id' => 'kk'],
        ['title' => 'Khmer', 'id' => 'km'],
        ['title' => 'Kikuyu, Gikuyu', 'id' => 'ki'],
        ['title' => 'Kinyarwanda', 'id' => 'rw'],
        ['title' => 'Kirghiz, Kyrgyz', 'id' => 'ky'],
        ['title' => 'Komi', 'id' => 'kv'],
        ['title' => 'Kongo', 'id' => 'kg'],
        ['title' => 'Korean', 'id' => 'ko'],
        ['title' => 'Kurdish', 'id' => 'ku'],
        ['title' => 'Kwanyama, Kuanyama', 'id' => 'kj'],
        ['title' => 'Latin', 'id' => 'la'],
        ['title' => 'Luxembourgish, Letzeburgesch', 'id' => 'lb'],
        ['title' => 'Luganda', 'id' => 'lg'],
        ['title' => 'Limburgish, Limburgan, Limburger', 'id' => 'li'],
        ['title' => 'Lingala', 'id' => 'ln'],
        ['title' => 'Lao', 'id' => 'lo'],
        ['title' => 'Lithuanian', 'id' => 'lt'],
        ['title' => 'Luba-Katanga', 'id' => 'lu'],
        ['title' => 'Latvian', 'id' => 'lv'],
        ['title' => 'Manx', 'id' => 'gv'],
        ['title' => 'Macedonian', 'id' => 'mk'],
        ['title' => 'Malagasy', 'id' => 'mg'],
        ['title' => 'Malay', 'id' => 'ms'],
        ['title' => 'Malayalam', 'id' => 'ml'],
        ['title' => 'Maltese', 'id' => 'mt'],
        ['title' => 'Māori', 'id' => 'mi'],
        ['title' => 'Marathi (Marāṭhī)', 'id' => 'mr'],
        ['title' => 'Marshallese', 'id' => 'mh'],
        ['title' => 'Mongolian', 'id' => 'mn'],
        ['title' => 'Nauru', 'id' => 'na'],
        ['title' => 'Navajo, Navaho', 'id' => 'nv'],
        ['title' => 'Norwegian Bokmål', 'id' => 'nb'],
        ['title' => 'North Ndebele', 'id' => 'nd'],
        ['title' => 'Nepali', 'id' => 'ne'],
        ['title' => 'Ndonga', 'id' => 'ng'],
        ['title' => 'Norwegian Nynorsk', 'id' => 'nn'],
        ['title' => 'Norwegian', 'id' => 'no'],
        ['title' => 'Nuosu', 'id' => 'ii'],
        ['title' => 'South Ndebele', 'id' => 'nr'],
        ['title' => 'Occitan', 'id' => 'oc'],
        ['title' => 'Ojibwe, Ojibwa', 'id' => 'oj'],
        ['title' => 'Oromo', 'id' => 'om'],
        ['title' => 'Oriya', 'id' => 'or'],
        ['title' => 'Ossetian, Ossetic', 'id' => 'os'],
        ['title' => 'Panjabi, Punjabi', 'id' => 'pa'],
        ['title' => 'Pāli', 'id' => 'pi'],
        ['title' => 'Persian', 'id' => 'fa'],
        ['title' => 'Polish', 'id' => 'pl'],
        ['title' => 'Pashto, Pushto', 'id' => 'ps'],
        ['title' => 'Portuguese', 'id' => 'pt'],
        ['title' => 'Quechua', 'id' => 'qu'],
        ['title' => 'Romansh', 'id' => 'rm'],
        ['title' => 'Kirundi', 'id' => 'rn'],
        ['title' => 'Romanian, Moldavian, Moldovan', 'id' => 'ro'],
        ['title' => 'Russian', 'id' => 'ru'],
        ['title' => 'Sanskrit (Saṁskṛta)', 'id' => 'sa'],
        ['title' => 'Sardinian', 'id' => 'sc'],
        ['title' => 'Sindhi', 'id' => 'sd'],
        ['title' => 'Northern Sami', 'id' => 'se'],
        ['title' => 'Samoan', 'id' => 'sm'],
        ['title' => 'Sango', 'id' => 'sg'],
        ['title' => 'Serbian', 'id' => 'sr'],
        ['title' => 'Scottish Gaelic; Gaelic', 'id' => 'gd'],
        ['title' => 'Shona', 'id' => 'sn'],
        ['title' => 'Sinhala, Sinhalese', 'id' => 'si'],
        ['title' => 'Slovak', 'id' => 'sk'],
        ['title' => 'Slovene', 'id' => 'sl'],
        ['title' => 'Somali', 'id' => 'so'],
        ['title' => 'Southern Sotho', 'id' => 'st'],
        ['title' => 'Spanish; Castilian', 'id' => 'es'],
        ['title' => 'Sundanese', 'id' => 'su'],
        ['title' => 'Swahili', 'id' => 'sw'],
        ['title' => 'Swati', 'id' => 'ss'],
        ['title' => 'Swedish', 'id' => 'sv'],
        ['title' => 'Tamil', 'id' => 'ta'],
        ['title' => 'Telugu', 'id' => 'te'],
        ['title' => 'Tajik', 'id' => 'tg'],
        ['title' => 'Thai', 'id' => 'th'],
        ['title' => 'Tigrinya', 'id' => 'ti'],
        ['title' => 'Tibetan Standard, Tibetan, Central', 'id' => 'bo'],
        ['title' => 'Turkmen', 'id' => 'tk'],
        ['title' => 'Tagalog', 'id' => 'tl'],
        ['title' => 'Tswana', 'id' => 'tn'],
        ['title' => 'Tonga (Tonga Islands)', 'id' => 'to'],
        ['title' => 'Turkish', 'id' => 'tr'],
        ['title' => 'Tsonga', 'id' => 'ts'],
        ['title' => 'Tatar', 'id' => 'tt'],
        ['title' => 'Twi', 'id' => 'tw'],
        ['title' => 'Tahitian', 'id' => 'ty'],
        ['title' => 'Uighur, Uyghur', 'id' => 'ug'],
        ['title' => 'Ukrainian', 'id' => 'uk'],
        ['title' => 'Urdu', 'id' => 'ur'],
        ['title' => 'Uzbek', 'id' => 'uz'],
        ['title' => 'Venda', 'id' => 've'],
        ['title' => 'Vietnamese', 'id' => 'vi'],
        ['title' => 'Volapük', 'id' => 'vo'],
        ['title' => 'Walloon', 'id' => 'wa'],
        ['title' => 'Welsh', 'id' => 'cy'],
        ['title' => 'Wolof', 'id' => 'wo'],
        ['title' => 'Western Frisian', 'id' => 'fy'],
        ['title' => 'Xhosa', 'id' => 'xh'],
        ['title' => 'Yiddish', 'id' => 'yi'],
        ['title' => 'Yoruba', 'id' => 'yo'],
        ['title' => 'Zhuang, Chuang', 'id' => 'za']
    ];

    if (!empty($ids)) {
        $language = collect($language)->whereIn('id', $ids)->values();
    }

    return $language;
}