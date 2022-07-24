@props(['product', 'name', 'user'])
<tr>
    <td class="pt-3-half">
        <a href="{{ route('merchant.products.show', ['user' => auth()->user()->id, 'product' => $product->id]) }}">
            <img src="{{ url('images/products/' . $product->image) }}" class="img-thumbnail square" alt="Product Image" />
        </a>
    </td>
    <td class="pt-3-half">{{ $product->name }}</td>
    @if ($name != 'none')
        <td class="pt-3-half">
            <div class="btn-group" role="group" aria-label="Basic example">

                @foreach ($name as $n)
                    @if (auth()->user()->products->contains($product->id))
                        <form
                            action=" {{ route('merchant.category.product.delete', ['user' => auth()->user()->id, 'category' => $n->id, 'product' => $product->id]) }}"
                            method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $n->id }}" />
                            <button type="submit" class="btn btn-danger btn-rounded btn-sm mr-2">
                                <i class="fas fa-trash " aria-hidden="true"></i> {{ $n->name }}
                            </button>
                        </form>
                    @else
                        <p>
                            {{ $n->name }}</i>
                        </p>
                    @endif
                @endforeach
            </div>
        </td>
    @endif
    <td class="pt-3-half">{{ $product->tags }}</td>
    <td class="pt-3-half">{{ $product->description }}</td>
    <td class="pt-3-half">{{ $product->price }}</td>
    <td class="pt-3-half">{{ $product->quantity }}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic example">

            @if (auth()->user()->products->contains($product->id))
                    <a href="{{ route('merchant.products.edit', ['user' => auth()->user()->id, 'product' => $product->id]) }}"
                        type="button" class="btn btn-warning btn-rounded btn-sm mr-2">
                        <i class="fas fa-edit mr-2" aria-hidden="true"> Edit</i>
                    </a>
                    <form
                        action=" {{ route('merchant.products.destroy', ['user' => auth()->user()->id, 'product' => $product->id]) }}"
                        method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-rounded btn-sm mr-2">
                            <i class="fas fa-trash " aria-hidden="true"> Remove</i>
                        </button>
                    </form>

            @else
                <span class="table-remove">
                    No action
                </span>
            @endif
        </div>
        {{-- @endif --}}
    </td>
</tr>
