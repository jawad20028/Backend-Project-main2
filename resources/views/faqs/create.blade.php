<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Ajouter une catégorie ou question</h2>

                    <!-- Messages de succès / erreur -->
                    @if(session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 text-red-600">{{ session('error') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('faqs.store') }}" method="POST">
                        @csrf

                        <!-- Type (catégorie ou FAQ) -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md" onchange="toggleFields(this)">
                                <option value="category" {{ old('type', 'category') === 'category' ? 'selected' : '' }}>Catégorie</option>
                                <option value="faq" {{ old('type') === 'faq' ? 'selected' : '' }}>Question/Réponse</option>
                            </select>
                            @error('type')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Champs catégorie -->
                        <div id="category-fields" class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom de la catégorie</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Champs FAQ -->
                        <div id="faq-fields" class="mb-4 hidden">
                            <label for="faq_category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select name="faq_category_id" id="faq_category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('faq_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('faq_category_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror

                            <label for="question" class="block text-sm font-medium text-gray-700 mt-4">Question</label>
                            <input type="text" name="question" id="question" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('question') }}">
                            @error('question')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror

                            <label for="answer" class="block text-sm font-medium text-gray-700 mt-4">Réponse</label>
                            <textarea name="answer" id="answer" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('answer') }}</textarea>
                            @error('answer')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
                    </form>

                    <script>
                        function toggleFields(select) {
                            const categoryFields = document.getElementById('category-fields');
                            const faqFields = document.getElementById('faq-fields');
                            const nameInput = document.getElementById('name');
                            const faqCategoryId = document.getElementById('faq_category_id');
                            const questionInput = document.getElementById('question');
                            const answerInput = document.getElementById('answer');

                            if (select.value === 'category') {
                                categoryFields.classList.remove('hidden');
                                faqFields.classList.add('hidden');
                                nameInput.removeAttribute('disabled');
                                faqCategoryId.setAttribute('disabled', 'disabled');
                                questionInput.setAttribute('disabled', 'disabled');
                                answerInput.setAttribute('disabled', 'disabled');
                            } else {
                                categoryFields.classList.add('hidden');
                                faqFields.classList.remove('hidden');
                                nameInput.setAttribute('disabled', 'disabled');
                                faqCategoryId.removeAttribute('disabled');
                                questionInput.removeAttribute('disabled');
                                answerInput.removeAttribute('disabled');
                            }
                        }

                        document.addEventListener('DOMContentLoaded', () => {
                            const typeSelect = document.getElementById('type');
                            toggleFields(typeSelect);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>