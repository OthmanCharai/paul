<?php

namespace App\Http\Requests;

use App\Enums\MeetStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed $doctor_id
 */
class StoreMeetRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'status'=>['required',new EnumValue(MeetStatus::class)],
            'start'=>'required',
            'doctor_id'=>'required',
            'description'=>'required',
            'title'=>'required',
        ];
    }
}
