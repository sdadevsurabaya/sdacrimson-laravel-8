@foreach ($ordersarray as $ordergroup)
    <div class="modal fade modal-middle" id="modalDetailOrder{{ $loop->index + 1 }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="exampleModalLabel">Order No. : {{ $ordergroup->nomerorder }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="table-responsive mb-3">
                            <table class="table table-borderless table-hover text-capitalize mb-3"
                                style="min-width: 720px;">
                                <thead class="border-bottom border-secondary">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">product</th>
                                        {{-- <th scope="col" class="text-nowrap text-center">Shipping Price</th> --}}
                                        <th scope="col" class="text-nowrap text-center">Price</th>
                                        <th scope="col" class="text-nowrap text-center">qty.</th>
                                        <th scope="col" class="text-nowrap text-center">total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (!empty($ordergroup->detailorder))
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($ordergroup->detailorder as $detail)
                                            <tr>
                                                <th scope="row">1.</th>
                                                <td>{{ $detail->namaproduk }}</td>
                                                {{-- <td class="text-nowrap text-end">
                                           <div class="w-100 d-flex justify-content-between mx-auto table-price">
                                              <div class="me-2">$.</div>
                                              <div>15.000,-</div>
                                           </div>
                                           </td> --}}
                                                <td class="text-nowrap text-end">
                                                    <div
                                                        class="w-100 d-flex justify-content-between mx-auto table-price">
                                                        <div class="me-2">$.</div>
                                                        <div>{{ $detail->hargaproduk }}</div>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap text-center">{{ $detail->qty }}</td>
                                                <td class="text-nowrap text-end">
                                                    <div
                                                        class="w-100 d-flex justify-content-between mx-auto table-price">
                                                        <div class="me-2">$.</div>
                                                        <div>{{ $detail->subtotalproduk }},-</div>
                                                        @php
                                                           $total = $total +  $detail->subtotalproduk
                                                        @endphp
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>Total. 
                                                 @php
                                            echo $total;
                                        @endphp
                                            </td>
                                        </tr>
                                       
                                    @endif

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
@endforeach
