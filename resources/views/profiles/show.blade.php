<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}: {{ $user->username ?? 'No Username Set' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>About Me:</strong> {{ $user->about_me ?? 'Not set' }}</p>
                    <p><strong>Birthday:</strong> {{ $user->verjaardag ?? 'Not set' }}</p>


                    <a href="{{ route('profile.edit') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>