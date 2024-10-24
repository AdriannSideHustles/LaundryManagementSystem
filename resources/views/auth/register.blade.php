{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   @vite(['resources/css/register.css'])

</head>
<body>
   
<div class="form-container">
    <form method="POST" action="{{ route('register') }}">
        @csrf
      <h3>Register Now</h3>
      
      <input required placeholder="Enter your Name" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"> 
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
      <input required placeholder="Enter your Email" id="email" type="email" name="email" :value="old('email')" required autocomplete="username">
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
      <input required placeholder="Enter your Password"id="password" type="password" name="password" required>
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
      <input required placeholder="Confirm your Password" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation">
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      <input type="submit" name="submit" value="{{ __('Register Now') }}" class="form-btn">
      <p>Already have an Account? <a href="{{ route('login') }}">login now</a></p>
   </form>

</div>

</body>
</html>