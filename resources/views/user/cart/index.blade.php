@extends('layouts.app')

@section('content')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container h-100 py-5">
            <div class="table-responsive">
                <table class="table product-table">
                    <!--Table head-->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>QTY</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <!--/Table head-->

                    <!--Table body-->
                    <tbody>
                        <x-cart-order />


                        <tr>
                            <td colspan="3"></td>
                            <td>
                                <h4><strong>Total</strong></h4>
                            </td>
                            <td>
                                <h4><strong>1200 $</strong></h4>
                            </td>
                            <td colspan="3"><button type="button" class="btn btn-primary">Complete purchase <i
                                        class="fa fa-angle-right right"></i></button></td>
                        </tr>
                        <!--/Fourth row-->

                    </tbody>
                    <!--/Table body-->
                </table>
            </div>
        </div>
    </section>
@endsection
