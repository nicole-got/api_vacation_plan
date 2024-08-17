<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Usuario;
use Carbon\Carbon;

class HolidayPlanRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'            => 'integer',
            'title'         => 'required|string|max:100',
            'description'   => 'required|string',
            'date'          => ['required', 'date', function ($attribute, $value, $fail) {
                if (!Carbon::parse($value)->between(Carbon::parse('2024-01-01'), Carbon::parse('2024-12-31'))) {
                    $fail('The date shall be in the year 2024.');
                }
            }],
            'participants'  => 'string|max:255',
        ];
    }
}
