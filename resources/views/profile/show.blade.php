<!DOCTYPE html>
<html>
<head>
    <title>Profiel van {{ $profile->username ?? 'Gebruiker' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Profiel van {{ $profile->username ?? 'Geen gebruikersnaam' }}</h1>
        
        @if($profile->profile_picture)
            <img src="{{ Storage::url($profile->profile_picture) }}" alt="Profielfoto" class="w-32 h-32 rounded-full mb-4">
        @else
            <div class="w-32 h-32 bg-gray-200 rounded-full mb-4 flex items-center justify-center">
                Geen foto
            </div>
        @endif

        @if($profile->birthday)
            <p><strong>Verjaardag:</strong> {{ $profile->birthday->format('d-m-Y') }}</p>
        @endif

        @if($profile->about_me)
            <p><strong>Over mij:</strong> {{ $profile->about_me }}</p>
        @endif

        @auth
            @if($profile->user_id === Auth::id())
                <a href="{{ route('profile.edit') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Bewerk profiel</a>
            @endif
        @endauth
    </div>
</body>
</html>