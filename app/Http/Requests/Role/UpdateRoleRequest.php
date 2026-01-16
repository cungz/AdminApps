<?php
// app/Http/Requests/Role/UpdateRoleRequest.php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('edit-roles');
    }

    public function rules(): array
    {
        $roleId = $this->route('role')->id;

        return [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $roleId],
            'description' => ['nullable', 'string', 'max:500'],
            'permissions' => ['required', 'array', 'min:1'],
            'permissions.*' => ['exists:permissions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Role name is required.',
            'name.unique' => 'This role name already exists.',
            'name.max' => 'Role name cannot exceed 255 characters.',
            'description.max' => 'Description cannot exceed 500 characters.',
            'permissions.required' => 'Please select at least one permission.',
            'permissions.min' => 'Role must have at least one permission.',
            'permissions.*.exists' => 'Selected permission does not exist.',
        ];
    }
}