   @props(['data'])

   <div class="col-md-4 col-xl-3">
    <div class="card bg-c-{{$data['color']}} order-card">
        <div class="card-block">
            <h6 class="m-b-20">{{ $data['title'] }}</h6>
            <h2 class="text-right"><i class="fa fa-{{$data['icon']}} f-left"></i><span>{{ $data['total'] }}</span></h2>
        </div>
    </div>
</div>
