<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Foire aux Questions (FAQ)</h2>

                    @if(session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 text-red-600">{{ session('error') }}</div>
                    @endif

                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('faqs.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Ajouter une catégorie ou question</a>
                        @endif
                    @endauth

                    @foreach($categories as $category)
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $category->name }}</h3>
                            @if(auth()->user()->is_admin ?? false)
                                <div class="mb-2">
                                    <a href="{{ route('faqs.edit', ['id' => $category->id, 'type' => 'category']) }}" class="text-blue-600 hover:text-blue-800">Modifier</a>
                                    <form action="{{ route('faqs.destroy', ['id' => $category->id, 'type' => 'category']) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Supprimer</button>
                                    </form>
                                </div>
                            @endif
                            @foreach($category->faqs as $faq)
                                <div class="mb-4">
                                    <p class="font-medium">{{ $faq->question }}</p>
                                    <p class="text-gray-600">{{ $faq->answer }}</p>
                                    @if(auth()->user()->is_admin ?? false)
                                        <div class="mt-2">
                                            <a href="{{ route('faqs.edit', ['id' => $faq->id, 'type' => 'faq']) }}" class="text-blue-600 hover:text-blue-800">Modifier</a>
                                            <form action="{{ route('faqs.destroy', ['id' => $faq->id, 'type' => 'faq']) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette question ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">Supprimer</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>