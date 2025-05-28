<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
       public function rules(): array
    {
        $leadId = $this->route('lead')->id ?? NULL;

        return [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:leads,email,' . $leadId,
            'phone'        => ['nullable', 'string', 'regex:/^\d+$/', 'min:10', 'max:15'],
            'status'       => 'required|in:new,contacted,closed',
            'assigned_to'  => 'required|exists:users,id',
            'notes'        => 'nullable|string|max:1000',
        ];
    }

}
