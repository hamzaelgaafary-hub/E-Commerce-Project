<x-guest-layout>


    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!--  Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <!--  Location -->
        <div class="mt-4">
            <x-input-label for="location" :value="__('location')" />
            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>
        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label :value="__('Register as : ')" />
            <div class="mt-2 space-y-3">
                
                @forelse ($roles as $role)
                
                    <label for="role_{{ $role->id }}" 
                        class="flex items-center p-3 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer
                             hover:bg-gray-50 dark:hover:bg-gray-700 transition 
                             {{ (old('role_id') == $role->id || (empty(old('role_id')) && $loop->first)) ? 
                            'bg-indigo-50 dark:bg-indigo-900 border-indigo-500' : '' }}">
                            
                        <input id="role_{{ $role->id }}" 
                            type="radio" 
                            name="role_id" 
                            value="{{$role->id}}"
                            {{ old('role_id') == $role->id || (empty(old('role_id')) && $loop->first) ? 'checked' : '' }}
                            class="rounded-full">
                        <span class="ml-3 font-medium text-gray-700 dark:text-gray-300">
                            {{ __(ucfirst($role->name)) }}
                        </span>
                    </label>
                    
                @empty
                    <p class="text-red-500">{{ __('No roles available') }}</p>
                @endforelse
            </div>
            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
        </div>




        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('auth.Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('auth.register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>