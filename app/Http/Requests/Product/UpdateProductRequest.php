<?php
declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateProductRequest
 * @package App\Http\Requests\Product
 */
class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        $product = $this->route('product');
        $productId = $product ? $product->id : 0;

        return [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $productId,
            'description' => 'string',
            'attribute_value_ids' => 'nullable|array',
            'attribute_value_ids.*.attribute_id' => 'integer|exists:attributes,id',
        ];
    }

    /**
     * @return int
     */
    public function categoryId(): int
    {
        return (int)$this->get('category_id', 0);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return (string)$this->get('name', '');
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return (string)$this->get('description', '');
    }

    /**
     * @return array
     */
    public function attributeValueIds(): array
    {
        return $this->get('attribute_value_ids', []);
    }

    /**
     * @return array
     */
    public function images(): array
    {
        return $this->get('images', []);
    }
}
