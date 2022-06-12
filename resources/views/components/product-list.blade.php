@props(['product', 'name'])
<tr>
    <td class="pt-3-half">
        <a href="{{ route('products.get', $product->id) }}">
            <img src="{{ url('images/products/' . $product->image) }}" class="img-thumbnail" alt="Product Image" />
            {{-- <img class="img" src="{{ url('images/products/' . $product->image) }}" alt="product_image" /> --}}
        </a>
    </td>
    <td class="pt-3-half">{{ $product->name }}</td>
    @if($name != "none")
        <td class="pt-3-half">
            <a type="button" id="{{$product->category_id }}" class="showCategory link-text">{{ $name }}</button>
        </td>
    @endif
    <td class="pt-3-half">{{ Str::limit($product->description, 20) }}</td>
    <td class="pt-3-half">{{ $product->price }}</td>
    <td class="pt-3-half">{{ $product->quantity }}</td>
    {{-- <td class="pt-3-half">
        <span class="table-up"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up"
                    aria-hidden="true"></i></a></span>
        <span class="table-down"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down"
                    aria-hidden="true"></i></a></span>
    </td> --}}
    <td>
        @if (auth()->user()->products->contains($product->id))
            <span class="table-remove mb-5">
                <button id="{{ $product->id }}" type="button"
                    class="btn btn-warning btn-rounded btn-sm my-0 editProduct">
                    <i class="fas fa-edit mr-5 ml-3" aria-hidden="true"> Edit</i>
                </button>
            </span>
            <span class="table-remove mt-2">
                <form action=" {{ route('product.delete', $product->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-rounded btn-sm my-0">
                        <i class="fas fa-trash " aria-hidden="true"> Remove</i>
                    </button>
                </form>

            </span>
        @else
            <span class="table-remove">
                No action
            </span>
        @endif
    </td>
</tr>
