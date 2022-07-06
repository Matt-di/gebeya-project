@props(['product', 'name','user'])
<tr>
    <td class="pt-3-half">
        <a href="{{ route('user.products.get', ['user'=>auth()->user()->id,'product'=>$product->id]) }}" >
            <img src="{{ url('images/products/' . $product->image) }}" class="img-thumbnail" style="height: 100px; width:100px;" alt="Product Image" />
        </a>
    </td>
    <td class="pt-3-half">{{ $product->name }}</td>
    @if ($name != 'none')
    <td class="pt-3-half">
        @foreach ($name as $n)
                <span class="table-remove mb-5">
                    <form action=" {{ route('user.category.product.delete', ['user'=>auth()->user()->id,'category'=>$n->id,'product'=>$product->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $n->id }}" />
                        <button type="submit" class="btn btn-success btn-rounded btn-sm my-0">
                            <i class="fas fa-trash " aria-hidden="true"> {{ $n->name }}</i>
                        </button>
                    </form>
                </span>
        @endforeach
        </td>
    @endif
    <td class="pt-3-half">{{ $product->tags}}</td>
    <td class="pt-3-half">{{ $product->description }}</td>
    <td class="pt-3-half">{{ $product->price }}</td>
    <td class="pt-3-half">{{ $product->quantity }}</td>
    <td>
        @if(auth('web'))
        {{-- @if(auth('web')->user()->products->contains($product->id)) --}}
            <span class="table-remove mb-5">
                <button id="{{ $product->id }}" type="button"
                    class="btn btn-warning btn-rounded btn-sm my-0 editproduct">
                    <i class="fas fa-edit mr-5 ml-3" aria-hidden="true"> Edit</i>
                </button>
            </span>
            <span class="table-remove mt-2">
                <form action=" {{ route('user.product.delete', ['user'=>auth()->user()->id,'product'=>$product->id]) }}" method="POST">
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
        {{-- @endif --}}
    </td>
</tr>
