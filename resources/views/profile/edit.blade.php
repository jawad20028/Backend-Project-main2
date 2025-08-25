<!DOCTYPE html>
<html>
<head>
    <title>Profiel Bewerken</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Profiel Bewerken</h1>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <!-- User fields (from Breeze) -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="border rounded w-full p-2">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="border rounded w-full p-2">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile fields -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium">Gebruikersnaam</label>
                <input type="text" name="username" id="username" value="{{ old('username', $profile->username) }}" class="border rounded w-full p-2">
                @error('username')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="birthday" class="block text-sm font-medium">Verjaardag</label>
                <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $profile->birthday) }}" class="border rounded w-full p-2">
                @error('birthday')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="profile_picture" class="block text-sm font-medium">Profielfoto</label>
                <input type="file" name="profile_picture" id="profile_picture" class="border rounded w-full p-2">
                @error('profile_picture')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="about_me" class="block text-sm font-medium">Over mij</label>
                <textarea name="about_me" id="about_me" class="border rounded w-full p-2">{{ old('about_me', $profile->about_me) }}</textarea>
                @error('about_me')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
        </form>

        <!-- Delete Account Form (from Breeze) -->
        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
            @csrf
            @method('DELETE')
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Wachtwoord (voor accountverwijdering)</label>
                <input type="password" name="password" id="password" class="border rounded w-full p-2">
                @error('password', 'userDeletion')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Weet je zeker dat je je account wilt verwijderen?')">Account Verwijderen</button>
        </form>
    </div>
</body>
</html>