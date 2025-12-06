<x-app-layout>
    
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Edit Product</h2>
            <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name', $product->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category_id" :value="__('Category_id')" />
                            <select id="category_id" name="category_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div>
                            <x-input-label for="price" :value="__('Price (L.E)')" />
                            <x-text-input id="price" class="block w-full mt-1" type="number" step="0.01" name="price" :value="old('price', $product->price)" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Stock Quantity -->
                        <div>
                            <x-input-label for="qty" :value="__('Stock qty')" />
                            <x-text-input id="qty" class="block w-full mt-1" type="number" name="qty" :value="old('qty', $product->qty)" required />
                            <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                        </div>

                        <!-- Trending Product -->
                        <div>
                            <x-input-label for="trend" :value="__('Trending Product')" />
                            <select id="trend" name="trend" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="0" {{ old('trend', $product->trend) == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('trend', $product->trend) == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                            <x-input-error :messages="$errors->get('trend')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Product Image -->
                        <div>
                            <x-input-label for="image" :value="__('Image')" />
                            <div class="mt-1 flex items-center">
                                <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" alt="Image" class="h-32 w-32 object-cover rounded-md">
                            </div>
                            <input id="image" class="block w-full mt-2 text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100"
                                type="file" 
                                name="image"
                                onchange="document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>

                        <!-- Short Description -->
                        <div>
                            <x-input-label for="short_description" :value="__('Short Description')" />
                            <textarea id="short_description" name="short_description" rows="3" 
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="A brief description of the product">{{ old('short_description', $product->short_description) }}</textarea>
                            <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Full Description -->
                <div class="mt-6">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" rows="5" 
                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Detailed product description" required>{{ old('description', $product->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end mt-8 space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <x-secondary-button type="button" onclick="window.location='{{ route('merchant.dashboard') }}'">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        {{ __('Update Product') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>