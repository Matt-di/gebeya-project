@props(['category'])
<form action="{{ route('category.get', $category->id) }}" method="POST">
    @csrf
    <div class="form-check pl-0 mb-2">
        <input type="radio" class="form-check-input" id="materialGroupExample2" name="groupOfMaterialRadios" checked>
        <label class="form-check-label" for="materialGroupExample2">{{$category->name}}</label>
    </div>
</form>
