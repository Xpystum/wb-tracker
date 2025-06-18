<?php

namespace App\Http\Requests;

use App\Data\ValueObject\UserVO;
use Illuminate\Foundation\Http\FormRequest;

class StatementStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'track_number' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:100', 'regex:/^[\p{L}\s\-]+$/u'],
            'surname' => ['required', 'string', 'max:100', 'regex:/^[\p{L}\s\-]+$/u'],
            'fathername' => ['nullable', 'string', 'max:100', 'regex:/^[\p{L}\s\-]+$/u'],
            'birthday' => ['required', 'date_format:d.m.Y', 'before:today'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9\s\-\(\)]+$/'],
            'series_passport' => ['required', 'string', 'max:20', 'regex:/^[A-Za-zА-Яа-я0-9\-]+$/u'],
            'number_passport' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages() : array
    {
        return [
            'name.regex' => 'Имя должно содержать только буквы, пробелы и дефисы.',
            'surname.regex' => 'Фамилия должна содержать только буквы, пробелы и дефисы.',
            'fathername.regex' => 'Отчество должно содержать только буквы, пробелы и дефисы.',
            'phone.regex' => 'Телефон должен содержать только цифры, пробелы, плюсы, дефисы и скобки.',
            'series_passport.regex' => 'Серия паспорта должна содержать только буквы, цифры и дефисы.',
            'number_passport.regex' => 'Номер паспорта должен содержать только цифры.',
        ];
    }

    public function arrayToUserVO() : UserVO
    {
        return UserVO::arrayToObject($this->validated());
    }
}
