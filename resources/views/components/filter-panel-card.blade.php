@props(['category'])

    <div class="form-check pl-0 mb-2">
        <input type="radio" class="form-check-input" id="category_id" name="category_id" value="{{$category->id}}" @if(request('category_id') == $category->id) checked @endif>
        <label class="form-check-label" for="materialGroupExample2">{{$category->name}}</label>
    </div>
