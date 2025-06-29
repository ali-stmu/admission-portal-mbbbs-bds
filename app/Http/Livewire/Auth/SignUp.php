<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignUp extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $nationality = '';
    public $cnic = '';
    public $passport = '';

    protected function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:6',
            'nationality' => 'required|in:local,foreign,special_foreign',
        ];
    
        // CNIC format validation if local, otherwise just required
        if ($this->nationality === 'local') {
            $rules['cnic'] = 'required|regex:/^\d{5}-\d{7}-\d{1}$/';
        } elseif (in_array($this->nationality, ['foreign', 'special_foreign'])) {
            $rules['cnic'] = 'required|min:5'; // Passport number format
        }
    
        return $rules;
    }
    

    public function register()
    {
        $this->validate();
    
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'nationality' => $this->nationality,
            'cnic' => $this->cnic, // store both CNIC or Passport here
            'role' => 'student', // Automatically set role to student
        ]);
    
        auth()->login($user);
    
        return redirect('/admission');
    }
    

    public function render()
    {
        return view('livewire.auth.sign-up');
    }
}