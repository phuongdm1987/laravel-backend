<?php
declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreProductUserRequest
 * @package App\Http\Requests\Product
 */
class StoreProductUserRequest extends FormRequest
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
        $rules = [
            'product_id' => 'required|integer|exists:products,id',
            'amount' => 'required|integer',
            'attribute_value_id' => 'required|array',
            'attribute_value_id.*' => 'required|integer|exists:attribute_values,id',
        ];

        return $rules;
    }

    /**
     * @return int
     */
    public function productId(): int
    {
        return (int)$this->get('product_id',0);
    }

    /**
     * @return int
     */
    public function userId(): int
    {
        return $this->user()->getId();
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return (int)$this->get('amount',0);
    }

    /**
     * @return array
     */
    public function attributeValueIds(): array
    {
        return (array)$this->get('attribute_value_id',[]);
    }
}
