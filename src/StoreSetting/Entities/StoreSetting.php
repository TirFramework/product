<?php

namespace Tir\Store\StoreSetting\Entities;

use Illuminate\Support\Facades\Cache;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Eloquent\Translatable;


class StoreSetting extends CrudModel
{
    //Additional trait insert here

    use Translatable;

    /**
     * The attribute show route name
     * and we use in fieldTypes and controllers
     *
     * @var string
     */
    public static $routeName = 'setting';

    public  $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'is_translatable', 'plain_value'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_translatable' => 'boolean',
        'plain_value' => 'array'

    ];


    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['value'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];


    /**
     * This function return array for validation
     *
     * @return array
     */
    public function getValidation()
    {
        return [
            'key' => 'required',
            'plain_value' => 'required'
        ];
    }


    /**
     * This function return an object of field
     * and we use this for generate admin panel page
     * @return Object
     */
    public function getFields()
    {


        $country = [
            'AF' =>'Afghanistan',
            'AX' =>'Åland Islands',
            'AL' =>'Albania',
            'DZ' =>'Algeria',
            'AS' =>'American Samoa',
            'AD' =>'Andorra',
            'AO' =>'Angola',
            'AI' =>'Anguilla',
            'AQ' =>'Antarctica',
            'AG' =>'Antigua &amp; Barbuda',
            'AR' =>'Argentina',
            'AM' =>'Armenia',
            'AW' =>'Aruba',
            'AC' =>'Ascension Island',
            'AU' =>'Australia',
            'AT' =>'Austria',
            'AZ' =>'Azerbaijan',
            'BS' =>'Bahamas',
            'BH' =>'Bahrain',
            'BD' =>'Bangladesh',
            'BB' =>'Barbados',
            'BY' =>'Belarus',
            'BE' =>'Belgium',
            'BZ' =>'Belize',
            'BJ' =>'Benin',
            'BM' =>'Bermuda',
            'BT' =>'Bhutan',
            'BO' =>'Bolivia',
            'BA' =>'Bosnia &amp; Herzegovina',
            'BW' =>'Botswana',
            'BR' =>'Brazil',
            'IO' =>'British Indian Ocean Territory',
            'VG' =>'British Virgin Islands',
            'BN' =>'Brunei',
            'BG' =>'Bulgaria',
            'BF' =>'Burkina Faso',
            'BI' =>'Burundi',
            'KH' =>'Cambodia',
            'CM' =>'Cameroon',
            'CA' =>'Canada',
            'IC' =>'Canary Islands',
            'CV' =>'Cape Verde',
            'BQ' =>'Caribbean Netherlands',
            'KY' =>'Cayman Islands',
            'CF' =>'Central African Republic',
            'EA' =>'Ceuta &amp; Melilla',
            'TD' =>'Chad',
            'CL' =>'Chile',
            'CN' =>'China',
            'CX' =>'Christmas Island',
            'CC' =>'Cocos (Keeling) Islands',
            'CO' =>'Colombia',
            'KM' =>'Comoros',
            'CG' =>'Congo - Brazzaville',
            'CD' =>'Congo - Kinshasa',
            'CK' =>'Cook Islands',
            'CR' =>'Costa Rica',
            'CI' =>'Côte d’Ivoire',
            'HR' =>'Croatia',
            'CU' =>'Cuba',
            'CW' =>'Curaçao',
            'CY' =>'Cyprus',
            'CZ' =>'Czechia',
            'DK' =>'Denmark',
            'DG' =>'Diego Garcia',
            'DJ' =>'Djibouti',
            'DM' =>'Dominica',
            'DO' =>'Dominican Republic',
            'EC' =>'Ecuador',
            'EG' =>'Egypt',
            'SV' =>'El Salvador',
            'GQ' =>'Equatorial Guinea',
            'ER' =>'Eritrea',
            'EE' =>'Estonia',
            'ET' =>'Ethiopia',
            'EZ' =>'Eurozone',
            'FK' =>'Falkland Islands',
            'FO' =>'Faroe Islands',
            'FJ' =>'Fiji',
            'FI' =>'Finland',
            'FR' =>'France',
            'GF' =>'French Guiana',
            'PF' =>'French Polynesia',
            'TF' =>'French Southern Territories',
            'GA' =>'Gabon',
            'GM' =>'Gambia',
            'GE' =>'Georgia',
            'DE' =>'Germany',
            'GH' =>'Ghana',
            'GI' =>'Gibraltar',
            'GR' =>'Greece',
            'GL' =>'Greenland',
            'GD' =>'Grenada',
            'GP' =>'Guadeloupe',
            'GU' =>'Guam',
            'GT' =>'Guatemala',
            'GG' =>'Guernsey',
            'GN' =>'Guinea',
            'GW' =>'Guinea-Bissau',
            'GY' =>'Guyana',
            'HT' =>'Haiti',
            'HN' =>'Honduras',
            'HK' =>'Hong Kong SAR China',
            'HU' =>'Hungary',
            'IS' =>'Iceland',
            'IN' =>'India',
            'ID' =>'Indonesia',
            'IR' =>'Iran',
            'IQ' =>'Iraq',
            'IE' =>'Ireland',
            'IM' =>'Isle of Man',
            'IL' =>'Israel',
            'IT' =>'Italy',
            'JM' =>'Jamaica',
            'JP' =>'Japan',
            'JE' =>'Jersey',
            'JO' =>'Jordan',
            'KZ' =>'Kazakhstan',
            'KE' =>'Kenya',
            'KI' =>'Kiribati',
            'XK' =>'Kosovo',
            'KW' =>'Kuwait',
            'KG' =>'Kyrgyzstan',
            'LA' =>'Laos',
            'LV' =>'Latvia',
            'LB' =>'Lebanon',
            'LS' =>'Lesotho',
            'LR' =>'Liberia',
            'LY' =>'Libya',
            'LI' =>'Liechtenstein',
            'LT' =>'Lithuania',
            'LU' =>'Luxembourg',
            'MO' =>'Macau SAR China',
            'MK' =>'Macedonia',
            'MG' =>'Madagascar',
            'MW' =>'Malawi',
            'MY' =>'Malaysia',
            'MV' =>'Maldives',
            'ML' =>'Mali',
            'MT' =>'Malta',
            'MH' =>'Marshall Islands',
            'MQ' =>'Martinique',
            'MR' =>'Mauritania',
            'MU' =>'Mauritius',
            'YT' =>'Mayotte',
            'MX' =>'Mexico',
            'FM' =>'Micronesia',
            'MD' =>'Moldova',
            'MC' =>'Monaco',
            'MN' =>'Mongolia',
            'ME' =>'Montenegro',
            'MS' =>'Montserrat',
            'MA' =>'Morocco',
            'MZ' =>'Mozambique',
            'MM' =>'Myanmar (Burma)',
            'NA' =>'Namibia',
            'NR' =>'Nauru',
            'NP' =>'Nepal',
            'NL' =>'Netherlands',
            'NC' =>'New Caledonia',
            'NZ' =>'New Zealand',
            'NI' =>'Nicaragua',
            'NE' =>'Niger',
            'NG' =>'Nigeria',
            'NU' =>'Niue',
            'NF' =>'Norfolk Island',
            'KP' =>'North Korea',
            'MP' =>'Northern Mariana Islands',
            'NO' =>'Norway',
            'OM' =>'Oman',
            'PK' =>'Pakistan',
            'PW' =>'Palau',
            'PS' =>'Palestinian Territories',
            'PA' =>'Panama',
            'PG' =>'Papua New Guinea',
            'PY' =>'Paraguay',
            'PE' =>'Peru',
            'PH' =>'Philippines',
            'PN' =>'Pitcairn Islands',
            'PL' =>'Poland',
            'PT' =>'Portugal',
            'PR' =>'Puerto Rico',
            'QA' =>'Qatar',
            'RE' =>'Réunion',
            'RO' =>'Romania',
            'RU' =>'Russia',
            'RW' =>'Rwanda',
            'WS' =>'Samoa',
            'SM' =>'San Marino',
            'ST' =>'São Tomé &amp; Príncipe',
            'SA' =>'Saudi Arabia',
            'SN' =>'Senegal',
            'RS' =>'Serbia',
            'SC' =>'Seychelles',
            'SL' =>'Sierra Leone',
            'SG' =>'Singapore',
            'SX' =>'Sint Maarten',
            'SK' =>'Slovakia',
            'SI' =>'Slovenia',
            'SB' =>'Solomon Islands',
            'SO' =>'Somalia',
            'ZA' =>'South Africa',
            'GS' =>'South Georgia &amp; South Sandwich Islands',
            'KR' =>'South Korea',
            'SS' =>'South Sudan',
            'ES' =>'Spain',
            'LK' =>'Sri Lanka',
            'BL' =>'St. Barthélemy',
            'SH' =>'St. Helena',
            'KN' =>'St. Kitts &amp; Nevis',
            'LC' =>'St. Lucia',
            'MF' =>'St. Martin',
            'PM' =>'St. Pierre &amp; Miquelon',
            'VC' =>'St. Vincent &amp; Grenadines',
            'SD' =>'Sudan',
            'SR' =>'Suriname',
            'SJ' =>'Svalbard &amp; Jan Mayen',
            'SZ' =>'Swaziland',
            'SE' =>'Sweden',
            'CH' =>'Switzerland',
            'SY' =>'Syria',
            'TW' =>'Taiwan',
            'TJ' =>'Tajikistan',
            'TZ' =>'Tanzania',
            'TH' =>'Thailand',
            'TL' =>'Timor-Leste',
            'TG' =>'Togo',
            'TK' =>'Tokelau',
            'TO' =>'Tonga',
            'TT' =>'Trinidad &amp; Tobago',
            'TA' =>'Tristan da Cunha',
            'TN' =>'Tunisia',
            'TR' =>'Turkey',
            'TM' =>'Turkmenistan',
            'TC' =>'Turks &amp; Caicos Islands',
            'TV' =>'Tuvalu',
            'UM' =>'U.S. Outlying Islands',
            'VI' =>'U.S. Virgin Islands',
            'UG' =>'Uganda',
            'UA' =>'Ukraine',
            'AE' =>'United Arab Emirates',
            'GB' =>'United Kingdom',
            'UN' =>'United Nations',
            'US' =>'United States',
            'UY' =>'Uruguay',
            'UZ' =>'Uzbekistan',
            'VU' =>'Vanuatu',
            'VA' =>'Vatican City',
            'VE' =>'Venezuela',
            'VN' =>'Vietnam',
            'WF' =>'Wallis &amp; Futuna',
            'EH' =>'Western Sahara',
            'YE' =>'Yemen',
            'ZM' =>'Zambia',
            'ZW' =>'Zimbabwe',
        ];

        $fields = [
            [
                'name' => 'basic_information',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'setting_information',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'       => 'id',
                                'type'       => 'text',
                                'visible'    => 'io',
                            ],
                            [
                                'name'      => 'supported_countries',
                                'type'      => 'select',
                                'multiple'  => true,
                                'data'      =>  $country,
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'default_country',
                                'type'      => 'select',
                                'data'      =>  $country,
                                'visible'   => 'ice',
                            ],

                            // [
                            //     'name'      => 'supported_locales',
                            //     'type'      => 'text',
                            //     'visible'   => 'ice',
                            // ],

                            [
                                'name'      => 'default_locale',
                                'type'      => 'text',
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'default_timezone',
                                'type'      => 'text',
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'customer_role',
                                'type'      => 'text',
                                'visible'   => 'ice',
                            ],

                            [
                                'name'      => 'reviews_enabled',
                                'display'   => 'Reviews & Ratings',
                                'type'      => 'select',
                                'data'      => [ 'ture' =>'yes', 'false'=>'no'],
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'auto_approve_reviews',
                                'display'   => 'Auto Approve Reviews',
                                'type'      => 'select',
                                'data'      => [ 'ture' =>'yes', 'false'=>'no'],
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'welcome_email',
                                'display'   => 'Welcome Email',
                                'type'      => 'select',
                                'data'      => [ 'ture' =>'yes', 'false'=>'no'],
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'admin_order_email',
                                'display'   => 'Admin Order Email',
                                'type'      => 'select',
                                'data'      => [ 'ture' =>'yes', 'false'=>'no'],
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'order_status_email',
                                'type'      => 'select',
                                'data'      => [ 'ture' =>'yes', 'false'=>'no'],
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'invoice_email',
                                'type'      => 'select',
                                'data'      => [ 'ture' =>'yes', 'false'=>'no'],
                                'visible'   => 'ice',
                            ],
                            [
                                'name'      => 'cookie_bar_enabled',
                                'type'      => 'select',
                                'data'      => [ 'ture' =>'yes', 'false'=>'no'],
                                'visible'   => 'ice',
                            ],
                        ]
                    ],
                    [
                        'name'  => 'maintenance',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [

                            [
                                'name'      => 'maintenance_mode',
                                'type'      => 'select',
                                'data'      => [ 'ture' =>'yes', 'false'=>'no'],
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'allowed_ips',
                                'type'      => 'textarea',
                                'visible'   => 'ce',
                            ],


                        ]
                    ],
                    [
                        'name'  => 'store',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'translatable[store_name]',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'translatable[store_tagline]',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'translatable[store_phone]',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'store_email',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'store_address_1',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'store_address_2',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'store_city',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'store_country',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'store_state',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'store_zip',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'currency',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'supported_currencies',
                                'type'      => 'select',
                                'multiple'  => true,
                                'data'      => $country,
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'default_currency',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'auto_refresh_currency_rates',
                                'type'      => 'select',
                                'data'      => [ 'true' =>'yes', 'false'=>'no'],
                                'script'    => $this->autoRefreshScript(),
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'auto_refresh_currency_rate_frequency',
                                'type'      => 'select',
                                'data'      => [ 'daily' =>'daily', 'weekly'=>'weekly','monthly'=>'monthly'],
                                'visible'   => 'ce',
                            ],

                        ],
                    ],
                    [
                        'name'  => 'mail',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'mail_from_address',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'mail_from_name',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'mail_host',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'mail_port',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'mail_username',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'mail_password',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'mail_encryption',
                                'type'      => 'select',
                                'data'      => [ 'ssl' =>'ssl', 'tls'=>'tls'],
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'newsletter',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'newsletter_enabled',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'mailchimp_api_key',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'mailchimp_list_id',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'custom_css-js',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'custom_header_assets',
                                'type'      => 'textarea',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'custom_footer_assets',
                                'type'      => 'textarea',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                ],




            ],
            [
                'name' => 'social_logins',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'facebook',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'facebook_login_enabled',
                                'type'      => 'select',
                                'data'      => [ 'true' =>'yes', 'false'=>'no'],
                                'script'    => '
                                    $("#facebook_login_app_id").parents(".form-group").addClass("d-none");
                                    $("#facebook_login_app_secret").parents(".form-group").addClass("d-none");
                                    $("#facebook_login_enabled").on("change", function() {
                                        if(this.value == "true"){
                                            $("#facebook_login_app_id").parents(".form-group").removeClass("d-none");
                                            $("#facebook_login_app_secret").parents(".form-group").removeClass("d-none");
                                        } else {
                                            $("#facebook_login_app_id").parents(".form-group").addClass("d-none");
                                            $("#facebook_login_app_secret").parents(".form-group").addClass("d-none");
                                        }
                                    });
                                ',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'facebook_login_app_id',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'facebook_login_app_secret',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'google',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'google_login_enabled',
                                'type'      => 'select',
                                'data'      => [ 'true' =>'yes', 'false'=>'no'],
                                'script'    => '
                                    $("#google_login_client_id").parents(".form-group").addClass("d-none");
                                    $("#google_login_client_secret").parents(".form-group").addClass("d-none");

                                    $("#google_login_enabled").on("change", function() {
                                        if(this.value == "true"){
                                            $("#google_login_client_id").parents(".form-group").removeClass("d-none");
                                            $("#google_login_client_secret").parents(".form-group").removeClass("d-none");
                                        } else {
                                            $("#google_login_client_id").parents(".form-group").addClass("d-none");
                                            $("#google_login_client_secret").parents(".form-group").addClass("d-none");
                                        }
                                    });
                                ',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'google_login_client_id',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'google_login_client_secret',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'shipping_methods',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'free_shipping',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'free_shipping_enabled',
                                'type'      => 'select',
                                'data'      => [ 'true' =>'yes', 'false'=>'no'],
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'translatable[free_shipping_label]',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'free_shipping_min_amount',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'local_pickup_enabled',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'local_pickup_enabled',
                                'type'      => 'select',
                                'data'      => [ 'true' =>'yes', 'false'=>'no'],
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'translatable[local_pickup_label]',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'local_pickup_cost',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                    [
                        'name'  => 'flat_rate',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'flat_rate_enabled',
                                'type'      => 'select',
                                'data'      => ['true' =>'yes', 'false'=>'no'],
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'translatable[flat_rate_label]',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'flat_rate_cost',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'payment_methods',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'cache_on_delivery',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'      => 'cod_enabled',
                                'type'      => 'select',
                                'data'      => [ 'true' =>'yes', 'false'=>'no'],
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'translatable[cod_label]',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'translatable[cod_description]',
                                'type'      => 'textarea',
                                'visible'   => 'ce',
                            ],
                        ]
                    ]
                ],
            ],

        ];

        return $fields;}


    private function autoRefreshScript()
    {
        return '
            $("#auto_refresh_currency_rate_frequency").parents(".form-group").addClass("d-none");
            $("#auto_refresh_currency_rates").on("change", function() {
                console.log(this.value);
                if(this.value == "true"){
                    $("#auto_refresh_currency_rate_frequency").parents(".form-group").removeClass("d-none");
                } else {
                    $("#auto_refresh_currency_rate_frequency").parents(".form-group").addClass("d-none");
                }
            });
        ';

    }

}
