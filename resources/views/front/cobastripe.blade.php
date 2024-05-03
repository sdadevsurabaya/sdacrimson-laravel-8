<main>
    <div class="row">
        <aside class="col-sm-6 offset-3">
            <article class="card">
                <div class="card-body p-5">
                    <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                                <i class="fa fa-credit-card"></i> Credit Card</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-tab-card">
                            @foreach (['danger', 'success'] as $status)
                                @if (Session::has($status))
                                    <p class="alert alert-{{ $status }}">{{ Session::get($status) }}</p>
                                @endif
                            @endforeach
                            {{-- <form role="form" method="POST" id="paymentForm"
                                action="{{ url('/cobastripepayment') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Full name (on the card)</label>
                                    <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">Card number</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cardNumber"
                                            placeholder="Card Number">
                                        <div class="input-group-append">
                                            <span class="input-group-text text-muted">
                                                <i class="fab fa-cc-visa fa-lg pr-1"></i>
                                                <i class="fab fa-cc-amex fa-lg pr-1"></i>
                                                <i class="fab fa-cc-mastercard fa-lg"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">Expiration</span> </label>
                                            <div class="input-group">
                                                <select class="form-control" name="month">
                                                    <option value="">MM</option>
                                                    @foreach (range(1, 12) as $month)
                                                        <option value="{{ $month }}">{{ $month }}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-control" name="year">
                                                    <option value="">YYYY</option>
                                                    @foreach (range(date('Y'), date('Y') + 10) as $year)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title=""
                                                data-original-title="3 digits code on back side of the card">CVV <i
                                                    class="fa fa-question-circle"></i></label>
                                            <input type="number" class="form-control" placeholder="CVV" name="cvv">
                                        </div>
                                    </div>
                                </div>
                                <button class="subscribe btn btn-primary btn-block" type="submit"> Confirm </button> --}}

                            <button class="btn btn-primary w-100 py-2" onClick="createcheckouts()">
                                <i class="bi bi-send me-2"></i> create checkouts
                            </button>
                            <button class="btn btn-primary w-100 py-2" onClick="checkstatuspayment()">
                                <i class="bi bi-send me-2"></i> check status payment
                            </button>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </article>
        </aside>
    </div>
</main>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function checkstatuspayment() {
        alert("test");
        axios({
                method: 'get',
                url: `https://stripe.com/docs/api/payment_intents?pi_1HmVFyG509Vx162NsITFHT5M`,
                // data: bodyFormData,
            })
            .then(response => {
                console.log(response.data);
                
                //masukkan kode pk_test disini
                // var stripe = Stripe('');
                // stripe
                //     .redirectToCheckout({
                //         sessionId: response.data.sessionId,
                //     })
                //     .then(handleResult);

            })
            .catch(function(err) {
                console.log(err);

            });
    }
    function createcheckouts() {
        alert("test payment");
        var bodyFormData = new FormData();
        bodyFormData.append('total', 720000);
    
        axios({
                method: 'post',
                // url: `http://127.0.0.1:8000/stripecheckouts`,
                //url: `https://project-supresso.suryoatmojo.id/stripecheckouts`,
                url: 'stripecheckouts',
                data: bodyFormData,
            })
            .then(response => {
                console.log(response.data);
                
                //masukkan kode pk_test disini
                var stripe = Stripe('');
                stripe
                    .redirectToCheckout({
                        sessionId: response.data.sessionId,
                    })
                    .then(handleResult);

            })
            .catch(function(err) {
                console.log(err);

            });
    }
</script>
