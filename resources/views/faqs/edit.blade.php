<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Modifier {{ $type === 'category' ? 'une catégorie' : 'une question' }}</h2>

                    @if(session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 text-red-600">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('faqs.update', ['id' => $item->id, 'type' => $type]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if($type === 'category')
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom de la catégorie</label>
                                <input type="text" name="name" id="name" value="{{ $item->name }}" class="mt-1 block w-full border-gray-300 rounded-md">
                                @error('name')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div class="mb-4">
                                <label for="faq_category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                                <select name="faq_category_id" id="faq_category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $item->faq_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('faq_category_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                                <input type="text" name="question" id="question" value="{{ $item->question }}" class="mt-1 block w-full border-gray-300 rounded-md">
                                @error('question')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="answer" class="block text-sm font-medium text-gray-700">Réponse</label>
                                <textarea name="answer" id="answer" class="mt-1 block w-full border-gray-300 rounded-md">{{ $item->answer }}</textarea>
                                @error('answer')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>