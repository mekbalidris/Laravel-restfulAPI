<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'name' => ['required'],
                'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
                'email' => ['required', 'email'],
                'address' => ['required'],
                'city' => ['required'],
                'state' => ['required'],
                'postalCode' => ['required'], // Match this key
            ];
        } else{
            return [
                'name' => ['sometimes'],
                'type' => ['sometimes', Rule::in(['I', 'B', 'i', 'b'])],
                'email' => ['sometimes', 'email'],
                'address' => ['sometimes'],
                'city' => ['sometimes'],
                'state' => ['sometimes'],
                'postalCode' => ['sometimes'],
            ];
        }
    }

    /**
     * Prepare data for validation.
     */
    protected function prepareForValidation()
        {
            if ($this->postalCode) {
                $this->merge([
                    'postal_code' => $this->postalCode, // Ensure this matches validation rules
                ]);
            }
        }
}
