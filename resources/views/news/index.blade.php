<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Nouvelles</h2>
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="{{ route('news.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Ajouter une nouvelle
                        </a>
                    @endif

                    @if($news->isEmpty())
                        <p>Aucune nouvelle trouvée.</p>
                    @else
                        @foreach($news as $item)
                            <div class="mb-6 p-4 border rounded">
                                <h3 class="text-xl font-semibold">{{ $item->title }}</h3>
                                <p class="text-gray-600 text-sm">Publié par {{ $item->user->username ?? $item->user->name }} le {{ $item->created_at->format('d-m-Y') }}</p>
                                <p class="mt-2">{{ Str::limit($item->description, 200) }}</p>
                                <div class="mt-2 flex space-x-2">
                                    <a href="{{ route('news.show', $item) }}" class="text-blue-500 hover:underline">Lire la suite</a>
                                    @if(auth()->check() && auth()->user()->is_admin)
                                        <a href="{{ route('news.edit', $item) }}" class="text-yellow-500 hover:underline">Modifier</a>
                                        <form action="{{ route('news.destroy', $item) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette nouvelle ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>