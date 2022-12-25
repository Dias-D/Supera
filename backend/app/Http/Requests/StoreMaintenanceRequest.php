<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StoreMaintenanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'car_id'        => ['required', 'exists:App\Models\Car,id'],
            'type'          => ['required', 'max:20'],
            'description'   => ['required', 'max:50'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Ops! Some errors occurred',
            'errors' => $validator->errors()
        ], Response::HTTP_BAD_REQUEST);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag);
    }
}
