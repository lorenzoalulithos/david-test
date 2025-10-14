<div
    x-show="modalOpen"
    x-transition.opacity
    class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
>
    <div
        class="bg-white relative p-6 rounded-xl shodow-xl max-w-lg w-full h-auto"
        @click.away="modalOpen = false"
    >
        <button
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
            @click="modalOpen = false"
        >
            ✕
        </button>

        <template x-if="selectedProduct">
            <form @submit.prevent="updateProduct" class="flex flex-col gap-3">
                <h2 class="text-2xl font-bold mb-2">Edit Product</h2>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold mb-1">Name</label>
                    <input
                        type="text"
                        x-model="selectedProduct.name"
                        class="border rounded w-full p-2"
                    />
                </div>

                <!-- Color -->
                <div>
                    <label class="block text-sm font-semibold mb-1">Color</label>
                    <select
                        x-model="selectedProduct.color"
                        class="border rounded w-full p-2"
                    >
                        @foreach($colors as $color)
                            <option value="{{ $color->color}}">{{ $color->color }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold mb-1">Category</label>
                    <select
                        x-model="selectedProduct.category_id"
                        class="border rounded w-full p-2"
                    >
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end mt-4">
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                        x-bind:disabled="saving"
                    >
                        <span x-show="!saving">Update</span>
                        <span x-show="saving">Saving...</span>
                    </button>
                </div>
            </form>
        </template>
    </div>

</div>

