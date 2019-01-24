<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginApiRequest
 * @package App\Http\Requests
 */
class LoginApiRequest extends FormRequest
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
            'client_id' => 'required|integer',
            'client_secret' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * @return int
     */
    public function clientId(): int
    {
        return (int)$this->get('client_id');
    }

    /**
     * @return string
     */
    public function clientSecret(): string
    {
        return $this->get('client_secret');
    }

    /**
     * @return string
     */
    public function emailAddress(): string
    {
        return $this->get('email');
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->get('password');
    }
}
