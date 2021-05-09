<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Task;

class EditTask extends CreateTask
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();
        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $statusLabel = array_map(function($item) {
            return $item['label'];
        }, TASK::STATUS);

        $statusLabelString = implode('、', $statusLabel);
        
        return $messages + [
            'status.in' => ':attribute には　' . $statusLabelString . '　のいずれかを指定してください。',
        ];
    }
}