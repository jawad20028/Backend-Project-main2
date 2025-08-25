<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if(session('status'))
                        <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium">Naam</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                class="border rounded w-full p-2 text-gray-900">
                            @error('name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium">E-mail</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                class="border rounded w-full p-2 text-gray-900">
                            @error('email')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium">Gebruikersnaam</label>
                            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" 
                                class="border rounded w-full p-2 text-gray-900">
                            @error('username')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- verjaardag -->
                        <div class="mb-4">
                            <label for="verjaardag" class="block text-sm font-medium">verjaardag</label>
                            <input type="date" name="verjaardag" id="verjaardag" value="{{ old('verjaardag', $user->verjaardag) }}" 
                                class="border rounded w-full p-2 text-gray-900">
                            @error('verjaardag')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- About Me -->
                        <div class="mb-4">
                            <label for="about_me" class="block text-sm font-medium">Over mij</label>
                            <textarea name="about_me" id="about_me" class="border rounded w-full p-2 text-gray-900">{{ old('about_me', $user->about_me) }}</textarea>
                            @error('about_me')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Save -->
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Opslaan
                        </button>
                    </form>

                    <!-- Delete Account -->
                    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
                        @csrf
                        @method('DELETE')
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium">Wachtwoord (voor accountverwijdering)</label>
                            <input type="password" name="password" id="password" 
                                class="border rounded w-full p-2 text-gray-900">
                            @error('password', 'userDeletion')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" 
                            onclick="return confirm('Weet je zeker dat je je account wilt verwijderen?')">
                            Account Verwijderen
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
