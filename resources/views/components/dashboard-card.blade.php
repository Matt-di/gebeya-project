@props(['data'])
<div class="col-xl-6 col-sm-6 col-12 mb-4 rounded-5 text-white" style="height: 250px">
    <div class="card ">
        <div class="card-body bg-primary ">
            <div class="d-flex justify-content-between px-md-1">
                <div>
                    <h3 class="text-success text-center">{{ $data['total'] }}</h3>
                    <p class="mb-0">{{ $data['title'] }}</p>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-{{ $data['icon'] }} text-success fa-3x"></i>
                </div>
            </div>
        </div>
        <a href="{{route('store.'.$data['link'],auth()->user()->id) }}" class="card-footer footer-hover black-text text-center border-0 p-2">More
            info<i class="fas fa-arrow-circle-right pl-2"></i></a>
    </div>
</div>
