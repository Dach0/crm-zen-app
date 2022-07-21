<?php

namespace App\Http\Requests;

use App\Models\ResourceItemType;
use Illuminate\Foundation\Http\FormRequest;

class StoreResourceItemRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title' => ['required','min:3','max:255'],
            'resource_item_type_id' => ['required','exists:resource_item_types,id']
        ];

        $selectedType = ResourceItemType::query()->find($this->resource_item_type_id);

        if ($selectedType?->type === 'PDF') {
            $rules['pdf_file'] = ['required','file','mimes:pdf','max:2048'];
        }

        if ($selectedType?->type === 'LINK') {
            $rules['link'] = ['required','url'];
        }

        return $rules;
    }
}
