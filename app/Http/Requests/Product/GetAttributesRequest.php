<?php
declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GetAttributesRequest
 * @package App\Http\Requests\Product
 */
class GetAttributesRequest extends FormRequest
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
            'categoryId' => 'required|integer|exists:categories,id',
            'productId' => 'required|integer|exists:products,id',
        ];

        return $rules;
    }

    /**
     * @return int
     */
    public function categoryId(): int
    {
        return (int)$this->get('categoryId',0);
    }

    /**
     * @return int
     */
    public function productId(): int
    {
        return (int)$this->get('productId',0);
    }
}
