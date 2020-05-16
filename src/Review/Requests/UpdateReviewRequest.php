<?php

namespace Tir\Store\Review\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rating' => 'required|numeric',
            'reviewer_name' => 'required',
            'comment' => 'required',
            'is_approved' => 'required|boolean',
        ];
    }
}
