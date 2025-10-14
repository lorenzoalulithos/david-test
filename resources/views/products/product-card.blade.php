<template x-for="product in products" :key="product.id">
    <div class="border rounded p-3 shadow-sm"  @click="selectProduct(product)">
        <h2 class="font-semibold" x-text="product.name"></h2>
        <p class="text-sm text-gray-500">
            Color: <span x-text="product.color"></span>
        </p>
        <p class="text-sm text-gray-500">
            Category ID: <span x-text="product.category_id"></span>
        </p>
    </div>
</template>
