<?php

namespace QuadStudio\Rbac\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name'        => 'required|alpha_dash|string|max:100|unique:roles',
                    'title'       => 'required|string|max:255',
                    'description' => 'max:255',
                ];
            }
            case 'PUT':
            case 'PATCH': {

                return [
                    'name'        => 'required|alpha_dash|string|max:100|unique:roles,name,' . $this->route()->parameter('role')->id,
                    'title'       => 'required|string|max:255',
                    'description' => 'max:255',
                ];
            }
            default:
                return [];
        }
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'        => trans('rbac::role.name'),
            'title'       => trans('rbac::role.title'),
            'description' => trans('rbac::role.description'),
        ];
    }
}
