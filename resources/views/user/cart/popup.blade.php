<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead" id="notifyTitle">Modal Success</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                    <p id="notifyMessage">Added to the cart</p>
                </div>
            </div>


            @auth()
                <div class="modal-footer border-top-0 d-flex justify-content-between">
                    <button id="addToCartModal" type="button" class="btn btn-secondary closeModal "
                        data-dismiss="modal">Close</button>
                    <a href="{{ route('user.cart', ['user' => auth()->user()->id]) }}" class="btn btn-success">
                        Checkout <i class="fa fa-angle-right right">
                        </i>
                    </a>
                </div>
            @endauth

        </div>
    </div>
</div>
