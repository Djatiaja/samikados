<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <table>
        <tr>
            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-input w-full">
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}"
                    class="w-16 h-16 object-cover rounded-md mb-2">
                <input type="file" name="thumbnail" class="form-input">
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-input w-full">
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <textarea name="description"
                    class="form-input w-full">{{ old('description', $product->description) }}</textarea>
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" class="form-input w-full">
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <input type="number" name="weight" step="0.01" value="{{ old('weight', $product->weight) }}"
                    class="form-input w-full">
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <input type="number" name="min_qty" value="{{ old('min_qty', $product->min_qty) }}"
                    class="form-input w-full">
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}"
                    class="form-input w-full">
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <input type="number" name="buy_price" step="0.01" value="{{ old('buy_price', $product->buy_price) }}"
                    class="form-input w-full">
            </td>

            <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                <select name="is_publish" class="form-select w-full">
                    <option value="1" {{ $product->is_publish ? 'selected' : '' }}>{{ __('Yes') }}</option>
                    <option value="0" {{ !$product->is_publish ? 'selected' : '' }}>{{ __('No') }}</option>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="10" class="p-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Update Product') }}
                </button>
            </td>
        </tr>
    </table>
</form>