<x-merchant-layout>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Add New blog</h2>

                <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- title -->
                        <div class="col-span-2">
                            <x-input-label for="title" :value="__('blog title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>
                        <!-- slug -->
                        <div class="col-span-2">
                            <x-input-label for="slug" :value="__('blog slug')" />
                            <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                                :value="old('slug')" required autofocus />
                            <x-input-error :messages="$errors->get('slug')" class="mt-1" />
                        </div>


                        <!-- Category -->
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                        </div>


                        <!-- Image -->
                        <div class="col-span-2">
                            <x-input-label for="image" :value="__('blog Image')" />
                            <div class="mt-1 flex items-center">
                                <input id="image"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    type="file" name="image" accept="image/*" onchange="previewImage(this)" />
                            </div>
                            <div class="mt-2" id="imagePreview"></div>
                            <x-input-error :messages="$errors->get('image')" class="mt-1" />
                        </div>
                    </div>

                    <!-- quote -->
                    <div class="space-y-6">
                        <!-- quote -->
                        <div>
                            <x-input-label for="quote" :value="__('Short quote')" />
                            <textarea id="quote" name="quote"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                rows="2" placeholder="A brief quote for the blog">{{ old('quote') }}</textarea>
                            <x-input-error :messages="$errors->get('quote')" class="mt-1" />
                        </div>

                        <!-- Full Description -->
                        <div>
                            <x-input-label for="content" :value="__('Full content')" />
                            <textarea id="content" name="content"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                rows="4" placeholder="Detailed blog content" required>{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <x-secondary-button type="button" onclick="window.location='{{ route('merchant.dashboard') }}'">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            {{ __('Create blog') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'mt-2 h-32 w-32 object-cover rounded-md border border-gray-200';
                    preview.appendChild(img);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-merchant-layout>