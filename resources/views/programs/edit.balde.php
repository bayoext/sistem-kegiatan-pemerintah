<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                {{ isset($program) ? 'Edit Program' : 'Create New Program' }}
            </h1>
            <p class="text-gray-600 mt-2">
                {{ isset($program) ? 'Update your program details' : 'Fill in the details to create a new program' }}
            </p>
        </div>

        <div class="card-primary">
            <form action="{{ isset($program) ? route('programs.update', $program) : route('programs.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($program))
                    @method('PUT')
                @endif

                <div class="space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Program Title *
                                </label>
                                <input type="text" name="title" value="{{ old('title', $program->title ?? '') }}"
                                       class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                       required>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Status *
                                </label>
                                <select name="status"
                                        class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500">
                                    <option value="Perencanaan" {{ old('status', $program->status ?? '') == 'Perencanaan' ? 'selected' : '' }}>
                                        Perencanaan
                                    </option>
                                    <option value="Berjalan" {{ old('status', $program->status ?? '') == 'Berjalan' ? 'selected' : '' }}>
                                        Berjalan
                                    </option>
                                    <option value="Selesai" {{ old('status', $program->status ?? '') == 'Selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                    <option value="Dibatalkan" {{ old('status', $program->status ?? '') == 'Dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Description *
                            </label>
                            <textarea name="description" rows="4"
                                      class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('description', $program->description ?? '') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Dates & Budget -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Timeline & Budget</h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Start Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Start Date *
                                </label>
                                <input type="date" name="start_date"
                                       value="{{ old('start_date', isset($program) ? $program->start_date->format('Y-m-d') : '') }}"
                                       class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                       required>
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    End Date *
                                </label>
                                <input type="date" name="end_date"
                                       value="{{ old('end_date', isset($program) ? $program->end_date->format('Y-m-d') : '') }}"
                                       class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                       required>
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Budget -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Budget
                                </label>
                                <input type="number" name="budget" step="0.01"
                                       value="{{ old('budget', $program->budget ?? '') }}"
                                       class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                       placeholder="0.00">
                                @error('budget')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Location & Thumbnail -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Additional Details</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Location -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Location
                                </label>
                                <input type="text" name="location"
                                       value="{{ old('location', $program->location ?? '') }}"
                                       class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                       placeholder="e.g., Jakarta, Indonesia">
                                @error('location')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Thumbnail -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Thumbnail Image
                                </label>
                                <input type="file" name="thumbnail"
                                       class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                       accept="image/*">
                                @error('thumbnail')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                @if(isset($program) && $program->thumbnail)
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-500 mb-2">Current Thumbnail:</p>
                                        <img src="{{ asset('storage/' . $program->thumbnail) }}"
                                             alt="{{ $program->title }}"
                                             class="w-32 h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Categories</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($categories as $category)
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                                       {{ isset($selectedCategories) && in_array($category->id, $selectedCategories) ? 'checked' : '' }}
                                       {{ old('categories') && in_array($category->id, old('categories')) ? 'checked' : '' }}>
                                <div class="ms-3 flex items-center">
                                    <div class="w-3 h-3 rounded-full mr-2" style="background-color: {{ $category->color }}"></div>
                                    <span class="text-sm text-gray-700">{{ $category->name }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>

                        @if($categories->isEmpty())
                            <div class="text-center py-6 border-2 border-dashed border-gray-300 rounded-lg">
                                <p class="text-gray-500">No categories available.</p>
                                <a href="{{ route('categories.create') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium mt-2 inline-block">
                                    Create a category first →
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('programs.index') }}"
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary">
                            {{ isset($program) ? 'Update Program' : 'Create Program' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
