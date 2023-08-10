<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
        if(request()->hasFile('file')){
            return [
                'name' => 'required',
                'sku' => 'required|string|min:5|max:10',
                'file' => 'required|mimes:jpeg,jpg,png',
                'price' => 'required',
                'date' => 'required'
            ];
        }else{

            return [
                'name' => 'required',
                'sku' => 'required|string|min:5|max:10',
                'price' => 'required',
                'date' => 'required'
            ];
        }
        
    }
     /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'name.required'  =>  "Name is required",
            'sku.required'   =>  "SKU is required",
            'file.required' => "image is required",
            'price.required' => "Price is required",
            'date.required' => "Expire date is required",
        ];
    }
}
