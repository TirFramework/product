<?php

namespace Tir\Store\Tax\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Tir\Store\Tax\Entities\TaxClass;
use Tir\Store\Admin\Traits\HasCrudActions;
use Tir\Store\Tax\Http\Requests\SaveTaxRequest;

class TaxController extends Controller
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = TaxClass::class;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['taxRates'];

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'tax::taxes.tax';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'tax::admin.taxes';

    /**
     * Route prefix of the resource.
     *
     * @var string
     */
    protected $routePrefix = 'admin.taxes';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveTaxRequest::class;
}
