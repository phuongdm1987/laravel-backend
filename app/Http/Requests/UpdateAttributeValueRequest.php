<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAttributeValueRequest
 * @package App\Http\Requests
 */
class UpdateAttributeValueRequest extends FormRequest
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
        return [
            'attribute_id' => 'nullable|integer|exists:attributes,id',
            'value' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
        ];
    }

    /**
     * @return int
     */
    public function attributeId(): int
    {
        return (int)$this->get('attribute_id',0);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return (string)$this->get('value');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return (string)$this->get('url');
    }
}
