@props(['category'])
<tr>
    <td class="pt-3-half">
        <a href="{{ route('merchant.category.products', ['user' => auth()->user()->id, 'category' => $category->id]) }}">{{ $category->name }}
        </a>
    </td>
    <td class="pt-3-half">{{ $category->description }}</td>
    <td class="pt-3-half">
        @if ($category->show_nav == 1)
            Enabled
        @else
            Diabled
        @endif
    </td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic example">
            @if (auth()->user()->categories->contains($category->id))
                <form
                    action=" {{ route('merchant.category.enable', ['user' => auth()->user()->id, 'category' => $category->id]) }} "
                    method="POST">
                    @csrf
                    <button type="submit"
                        class="btn mr-2  btn-rounded  @if ($category->show_nav == 1) btn-warning @else btn-success @endif">
                        <i class="fas fa-check" aria-hidden="true"> </i>
                        @if ($category->show_nav == 1)
                            Remove Nav
                        @else
                            Show Nav
                        @endif
                    </button>
                </form>
                <span>
                    <a href="{{ route('merchant.categories.edit', ['user' => auth()->user()->id, 'category' => $category->id]) }}"
                        type="submit" class="btn btn-warning btn-rounded btn-sm mr-2">
                        <i class="fas fa-edit" aria-hidden="true"> </i>Edit
                    </a>
                </span>
                <form
                    action=" {{ route('merchant.categories.destroy', ['user' => auth()->user()->id, 'category' => $category->id]) }}"
                    method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-rounded btn-sm">
                        <i class="fas fa-trash" aria-hidden="true"></i>Remove
                    </button>
                </form>
            @else
                <span class="  table-remove mb-5">
                    <p>No Action</p>
                </span>
            @endif
        </div>



    </td>
</tr>
<script></script>
