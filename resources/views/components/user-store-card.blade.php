@props(['store'])
<div class="card m-2" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">{{ $store->firstname }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $store->products->count() }} Products</h6>
        <p class="card-text">get this store products</p>
        <a class="btn btn-link" href="{{ route('user.stores.show', $store->id) }}" class="card-link">Explore More</a>
    </div>
</div>
