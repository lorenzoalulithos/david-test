<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>


        <!-- Styles -->

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen">
                <div class="relative w-full">
                    <div class="flex flex-col h-screen">
                        <!-- Header -->
                        <header class="bg-gray-200 text-gray-800 p-4">
                            <h1 class="text-2xl font-bold mb-4">Product List</h1>
                        </header>

                        <!-- Main content -->
                           <main x-data="productList()" x-init="init()" class="flex flex-col md:flex-row flex-1 overflow-hidden gap-4">

                                <aside class="bg-gray-100 border-r p-4 sticky top-0 self-start h-auto md:h-full w-full md:w-auto  flex flex-col gap-2">
                                    <select x-model="filters.category_id" @change="updateFilters" class="border rounded p-2">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Color Filter -->
                                    <select x-model="filters.color" @change="updateFilters" class="border rounded p-2">
                                        <option value="">All Colors</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->color}}">{{ $color->color }}</option>
                                        @endforeach
                                    </select>
                                </aside>
                                <section class="flex-1 overflow-auto p-4">

                                    <template x-if="loading">
                                        <div class="h-full w-full flex items-center justify-center">
                                            <p class="text-gray-500">Loading products...</p>
                                        </div>
                                    </template>

                                    <!-- Product List -->
                                    <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-4" x-show="!loading">
                                        @include('products.product-card')
                                    </div>
                                </section>
                               @include('products.product-edit')
                           </main>
                        <!-- Footer -->
                        <footer class="bg-gray-200 text-gray-800 p-4">
                            Footer
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

{{-- TODO: move to file when I'll figure out how to import js files  --}}

<script>
    function productList() {
        return {
            loading: true,
            saving: false,

            products: [],
            filters: { color: '', category_id: '' },

            modalOpen: false,
            selectedProduct: null,

            async init() {
                const params = new URLSearchParams(window.location.search);
                this.filters.color = params.get('color') || '';
                this.filters.category_id = params.get('category_id') || '';

                await this.fetchProducts(false);

                window.addEventListener('popstate', () => {
                    const params = new URLSearchParams(window.location.search);
                    this.filters.color = params.get('color') || '';
                    this.filters.category_id = params.get('category_id') || '';
                    this.fetchProducts(false);
                });
            },

            async fetchProducts(updateUrl = true) {
                this.loading = true;
                const params = new URLSearchParams(this.filters).toString();
                const res = await fetch(`/api/products?${params}`,{
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                });
                this.products = await res.json();
                this.loading = false;

                if (updateUrl) this.updateUrl();
            },

            updateUrl() {
                const params = new URLSearchParams(this.filters);
                const query = params.toString();
                const newUrl = query ? `?${query}` : window.location.pathname;
                window.history.pushState({}, '', newUrl);
            },

            updateFilters() {
                this.fetchProducts();
            },

            selectProduct(product) {
                // pass value , not reference
                this.selectedProduct = JSON.parse(JSON.stringify(product));
                this.modalOpen = true
            },

            async updateProduct() {
                try {
                    const res = await fetch(`/api/product/${this.selectedProduct.id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                        },
                        body: JSON.stringify(this.selectedProduct)
                    });
                    if (!res.ok) throw new Error('Failed to update product');

                    await this.fetchProducts();
                    this.modalOpen = false;
                } catch (err) {
                    alert(err.message);
                } finally {
                    this.saving = false;
                }
            }
        }
    }
</script>
