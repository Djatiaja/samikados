<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{route('product.search')}}" method="get">
                    <input type="text" id="search" name="search">
                    <button type="submit">search</button>
                </form>
                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr class="border border-gray-300 md:border-none md:table-row">
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('SKU') }}
                            </th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{
                                __('Thumbnail') }}</th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('Name') }}
                            </th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{
                                __('Description') }}</th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('Unit') }}
                            </th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('Weight')
                                }}</th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('Min Qty')
                                }}</th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('Price') }}
                            </th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('Buy
                                Price') }}</th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('Is
                                Published') }}</th>
                            <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">{{ __('Actions')
                                }}</th>
                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group">
                        @foreach($products as $product)
                        <tr class="border border-gray-300 md:border-none md:table-row">
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $product->sku }}</td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                                <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}"
                                    class="w-16 h-16 object-cover">
                            </td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $product->name }}</td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{
                                Str::limit($product->description, 50) }}</td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $product->unit }}</td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $product->weight }}</td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $product->min_qty }}
                            </td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $product->price }}</td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $product->buy_price }}
                            </td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                                {{ $product->is_publish ? __('Yes') : __('No') }}
                            </td>
                            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                                <form action="{{route('product.restore', $product->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">restore</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}
        </div>
    </div>
</div>