<?php

namespace QuadStudio\Rbac\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $table;

    /**
     * RoleRequest constructor.
     * @param array $query
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param null $content
     */
    public function __construct(array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->table = env("DB_PREFIX", "") . 'roles';
    }

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
                    'name'        => 'required|alpha_dash|string|max:100|unique:' . $this->table,
                    'title'       => 'required|string|max:255',
                    'description' => 'max:255',
                ];
            }
            case 'PUT':
            case 'PATCH': {

                return [
                    'name'        => 'required|alpha_dash|string|max:100|unique:' . $this->table . ',name,' . $this->route()->parameter('role')->id,
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
