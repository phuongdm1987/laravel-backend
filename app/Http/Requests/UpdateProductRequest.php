<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateProductRequest
 * @package App\Http\Requests
 */
class UpdateProductRequest extends FormRequest
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
        $product = $this->route('product');

        return [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'string',
        ];
    }

    /**
     * @return int
     */
    public function categoryId(): int
    {
        return (int)$this->get('category_id',0);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return (string)$this->get('name','');
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return (string)$this->get('description','');
    }
}
