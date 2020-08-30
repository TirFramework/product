<?php

namespace Tir\Store\Support;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

abstract class Request extends FormRequest
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = '';

    /**
     * Current processed locale.
     *
     * @var string
     */
    protected $localeKey;

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        $attributes = trans($this->availableAttributes) ?: [];

        if (! is_array($attributes)) {
            return [];
        }

        return array_map('mb_strtolower', Arr::dot($attributes));
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return array_merge([
            '*.required_if' => trans(config('crud.front-template').'::validation.required'),
            '*.required_unless' => trans(config('crud.front-template').'::validation.required'),
            '*.required_with' => trans(config('crud.front-template').'::validation.required'),
            '*.required_with_all' => trans(config('crud.front-template').'::validation.required'),
            '*.required_without' => trans(config('crud.front-template').'::validation.required'),
            '*.required_without_all' => trans(config('crud.front-template').'::validation.required'),
        ], $this->getDefaultMessages());
    }

    /**
     * Ger default validations messages for the given rules.
     *
     * @return array
     */
    protected function getDefaultMessages()
    {
        $attributesAndRules = $this->parseRules($this->rules());

        $messages = [];

        foreach ($attributesAndRules as $attributeAndRule) {
            $rule = last(explode('.', $attributeAndRule));

            $messages[$attributeAndRule] = trans(config('crud.front-template')."::validation.{$rule}");
        }

        return $messages;
    }

    /**
     * Parse rules for the given attributes.
     *
     * Gives
     * [
     *  'name' => 'required|size:60',
     * ]
     *
     * Returns
     * [
     *  'name.required',
     *  'name.size',
     * ]
     *
     * @param array $rules
     * @return array
     */
    protected function parseRules(array $rules)
    {
        $attributesAndRules = [];

        foreach ($rules as $attribute => $rulesList) {
            if (! is_array($rulesList)) {
                $rulesList = explode('|', $rulesList);
            }

            foreach ($rulesList as $rule) {
                if ($rule instanceof Closure) {
                    continue;
                }

                if (strpos($rule, ':') !== false) {
                    list($rule) = explode(':', $rule, 2);
                }

                $attributesAndRules[] = "{$attribute}.{$rule}";
            }
        }

        return $attributesAndRules;
    }
}
