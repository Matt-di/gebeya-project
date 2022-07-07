@props(['category'])
<tr>
    <td class="pt-3-half">
        <a href="{{route('store.category.products',['user'=>auth()->user()->id,'category'=>$category->id]) }}">{{ $category->name }} </a>
    </td>
    <td class="pt-3-half">{{ $category->description }}</td>
    <td class="pt-3-half">
        <form action=" {{ route('store.category.enable',['user'=>auth()->user()->id, 'category'=>$category->id]) }} " method="POST">
            @csrf
            <button type="submit" class="btn  @if ($category->show_nav == 1) btn-warning @else btn-success @endif">
                @if ($category->show_nav == 1)
                    Disable
                @else
                    Enable
                @endif
            </button>
        </form>
    </td>
    <td>
        @if (auth()->user()->categories->contains($category->id))
            <span class="  table-remove mb-5">
                <button id="{{ $category->id }}" type="submit" class="btn btn-warning btn-rounded btn-sm my-0 editcategory">
                    <i class="fas fa-edit mr-5" aria-hidden="true"> Edit</i>
                </button>
            </span>
            <span class="table-remove">
                <form action=" {{ route('store.category.delete', ['user'=>auth()->user()->id,'category'=>$category->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-rounded btn-sm my-0">
                        <i class="fas fa-trash mr-5" aria-hidden="true"> Remove</i>
                    </button>
                </form>
            </span>
        @else
            <span class="  table-remove mb-5">
                <p>No Action</p>

            </span>
        @endif


    </td>
</tr>
<script></script>
