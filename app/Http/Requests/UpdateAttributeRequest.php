<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAttributeRequest
 * @package App\Http\Requests
 */
class UpdateAttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $attribute = $this->route('attribute');
        $attributeId = $attribute ? $attribute->id : 0;
        
        return [
            'name' => 'required|string|unique:attributes,name,' . $attributeId,
        ];
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return (string)$this->get('name');
    }
}
