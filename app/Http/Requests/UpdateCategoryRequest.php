<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Henry\Domain\Category\ValueObjects\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

/**
 * Class UpdateCategoryRequest
 * @package App\Http\Requests
 */
class UpdateCategoryRequest extends FormRequest
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
        $category = $this->route('category');
        $categoryId = $category ? $category->id : 0;

        return [
            'parent_id' => 'nullable|integer|exists:categories,id',
            'name' => 'required|string|max:255|unique:categories,name,' . $categoryId,
            'type' => 'required|string|in:' . implode(',', Type::getAll()),
            'attributes' => 'nullable|array',
            'attributes.*.id' => 'integer|exists:attributes,id|',
            'attributes.*.can_change' => 'bool|required'
        ];
    }

    /**
     * @return int
     */
    public function parentId(): int
    {
        return (int)$this->get('parent_id',0);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return (string)$this->get('name');
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return (string)$this->get('type');
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return (array)$this->get('attributes', []);
    }

    /**
     * @return array
     */
    public function attributeIds(): array
    {
        return Arr::pluck((array)$this->get('attributes', []), 'id');
    }
}
