<div class="max-w-xl bg-white rounded-xl shadow p-6">
    <form action="{{ $action }}" method="POST" class="space-y-4">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif

        <div>
            <label class="block mb-1 font-medium">Category Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="w-full border rounded px-3 py-2">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button class="bg-sky-600 text-white px-5 py-2 rounded hover:bg-sky-700">Save</button>
    </form>
</div>
