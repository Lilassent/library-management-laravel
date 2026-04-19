<div class="bg-white rounded-xl shadow p-6">
    <form action="{{ $action }}" method="POST" class="space-y-4">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif

        <div>
            <label class="block mb-1 font-medium">Title</label>
            <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}" class="w-full border rounded px-3 py-2">
            @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Author</label>
            <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}" class="w-full border rounded px-3 py-2">
            @error('author') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $book->description ?? '') }}</textarea>
            @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Published Year</label>
                <input type="number" name="published_year" value="{{ old('published_year', $book->published_year ?? '') }}" class="w-full border rounded px-3 py-2">
                @error('published_year') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Available Copies</label>
                <input type="number" name="available_copies" value="{{ old('available_copies', $book->available_copies ?? 1) }}" class="w-full border rounded px-3 py-2">
                @error('available_copies') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <button class="bg-sky-600 text-white px-5 py-2 rounded hover:bg-sky-700">Save</button>
    </form>
</div>
