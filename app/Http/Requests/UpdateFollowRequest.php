<?php

namespace App\Http\Requests;

use App\Models\Follow;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateFollowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $follow = Follow::find($this->route('id'));
        return $follow && Auth::user()->id === $follow->user_id1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id2' => '',
            'status' => '',
        ];
    }
}
