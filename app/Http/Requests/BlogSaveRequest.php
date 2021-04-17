<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogSaveRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'is_open' => ['nullable'],
            'pict' => ['image', 'max:5000'],
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        // $validated = $this->validator->validated();

        return array_merge($this->validator->validated(), [
            'is_open' => $this->boolean('is_open'),
        ]);
    }

    /**
     * 画像を保存し、検証済みの登録・更新用データを返す
     *
     * @return array
     */
    public function proceed()
    {
        $data = $this->validated();

        if ($this->hasFile('pict')) {
            // 古い画像の削除はイベント使って削除します
            $data['pict'] = $this->file('pict')->store('blogs', 'public');
        }

        return $data;
    }
}
