<?php

namespace App\Modules\Transactions\Controllers\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReceiveRequest extends FormRequest
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

    public function getLoggedUserId():int
    {
        return $this->user()->id;
    }

    public function rules()
    {
        return [];
    }
}
