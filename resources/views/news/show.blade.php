<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">{{ $news->title }}</h2>
                    <p class="text-gray-600 text-sm mb-4">Publié par {{ $news->user->username ?? $news->user->name }} le {{ $news->created_at->format('d-m-Y') }}</p>
                    <p>{!! nl2br(e($news->description)) !!}</p>
                    <a href="{{ route('news.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>