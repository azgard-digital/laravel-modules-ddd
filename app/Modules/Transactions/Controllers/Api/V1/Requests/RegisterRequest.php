<?php

namespace App\Modules\Transactions\Controllers\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
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

    /*public function attributes()
    {
        $wallets = $this->request->get('wallets', []);

        $d = [
            'wallet_from' => $wallets['from'] ?? null,
            'wallet_to' => $wallets['to'] ?? null,
            'amount' => (int)$this->request->get('amount')
        ];

        return $d;
    }*/

    public function getLoggedUserId():int
    {
        return $this->user()->id;
    }

    public function getWalletFrom():string
    {
        return $this->json('wallets.from');
    }

    public function getWalletTo():string
    {
        return $this->json('wallets.to');
    }

    public function getAmount():int
    {
        return $this->get('amount');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wallets.from' => 'required|string|max:32|min:32|isCorrectTransactionWallet',
            'amount' => 'required|integer',
            'wallets.to' => 'required|string|min:32|max:32|different:wallets.from|exists:wallets,address',
        ];
    }
}
