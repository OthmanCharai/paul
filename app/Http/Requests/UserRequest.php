<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
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
        $rules=[
            'name'=>'required',
            'password'=>'required | min:8',
        ];
        if(request()->method=='POST'){
            array_merge($rules,[
                'email'=>[
                    'required',
                    Rule::unique('users')
                ]
            ]);
        }else{
            array_merge($rules,[
                'email'=>[
                    'required',
                    Rule::unique('users')->ignore($this->id)
                ]
            ]);
        }

        return $rules;
    }
}

/* To get started:

1. Send HTTP or webhook requests to the endpoint URL above (e.g., https://XXXXXXXX.m.pipedream.net).
2. Select events to inspect them.
3. Optionally edit this workflow (modify this code, add steps, etc).

Then explore how Pipedream can help you connect APIs for 500+ apps, remarkably fast:

- Build workflows composed of code steps (Node.js, Python, Go, Bash) and open source, pre-built actions.
- Trigger workflows on HTTP requests, schedules, app events and more.
- Connect OAuth and key-based API accounts in seconds and use them in codes steps and actions.

Learn more at https://pipedream.com/quickstart */


  
