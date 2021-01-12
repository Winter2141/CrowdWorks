<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

class UserRequest extends FormRequest
{
    protected $action;
    protected $user_kind;

    public function __construct(Request $request, Factory $factory)
    {
        parent::__construct();
        $this->action = !empty($request->route()->getName()) ? $request->route()->getName() : '';
        $this->user_kind = $request->input('user_kind');
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
        $rules =[
            'name' => ['required', 'string', 'max:150'],

        ];

        return $rules;
    }

    public function attributes()
    {
        $attributes = parent::attributes();
        return $attributes;
    }

    public function messages()
    {
        $messages = [
            'name.required'=> '氏名を入力してください。',
            /*
             *  Add messages
            */
        ];

        return $messages;
    }

}
