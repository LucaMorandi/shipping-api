<?php

namespace App\Http\Requests\Users;

use Domain\Users\Interfaces\UserRepositoryInterface;
use Domain\Users\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class ApiTokenCreateRequest extends FormRequest  {

  private string $error_message = 'The provided credentials are incorrect.';

  public function __construct(private readonly UserRepositoryInterface $userRepository) {
    parent::__construct();
  }

  public function rules(): array {
    return [
      'email' => ['required', 'email'],
      'password' => ['required', 'string'],
      'device_name' => ['required', 'string'],
    ];
  }

  public function after(): array {
    return [
      function (Validator $validator) {
        $user = $this->getUserByEmail();

        if (!$user || !Hash::check($this->input('password'), $user->password)) {
          $validator->errors()->add('email', $this->error_message);
          $validator->errors()->add('password', $this->error_message);
        }
      }
    ];
  }

  public function getEmail(): string {
    return $this->validated('email');
  }

  public function getDeviceName(): string {
    return $this->validated('device_name');
  }

  private function getUserByEmail(): User | null {
    return $this->userRepository->getUserByEmail($this->getEmail());
  }

}
