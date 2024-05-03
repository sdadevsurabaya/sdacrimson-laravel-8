<div class="modal fade modal-middle" id="modalEditRecipients" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="exampleModalLabel">Edit Recipients</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="test" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-lg-6">
                                    <input type="hidden" class="form-control border-0 px-0 text-uppercase"
                                        id="editid" value="">
                                    <input type="text" class="form-control border-0 px-0 text-uppercase"
                                        id="editidmembers" value="{{ $userId }}">
                                    <input type="hidden" class="form-control border-0 px-0 text-uppercase"
                                        id="index" value="">

                                    <div class="form-floating border-bottom mb-3">
                                        <input type="text" class="form-control border-0 px-0 text-uppercase"
                                            id="editsubject" placeholder="Subject Name" value="Home">
                                        <label for="userSubjectName" class="px-0">Subject Name*</label>
                                    </div>

                                    <div class="form-floating border-bottom mb-3">
                                        <input type="text" class="form-control border-0 px-0 text-uppercase"
                                            id="editrecepient" placeholder="Recipient Name">
                                        <label for="userRecipientname" class="px-0">Recipient Name*</label>
                                    </div>

                                    <div class="form-floating border-bottom mb-3">
                                        <input type="text" class="form-control border-0 px-0 text-uppercase"
                                            id="editphone" placeholder="Phone Number">
                                        <label for="userPhone" class="px-0">Phone Number*</label>
                                    </div>

                                    <div class="form-floating border-bottom mb-3">
                                        <input type="email" class="form-control border-0 px-0 text-lowercase"
                                            id="editemail" placeholder="Email">
                                        <label for="userEmail" class="px-0">Email</label>
                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="form-select2 mb-3 border-bottom">
                                        <label class="px-0" for="userSelectCountry">Country*</label>
                                        <select class="form-select px-0 border-0 rounded-0" id="editcountry"
                                            aria-label="Floating label select">
                                            <option selected>Indonesia</option>
                                            <option value="2">Singapore</option>
                                            <option value="3">Malaysia</option>
                                        </select>
                                    </div>

                                    <div class="form-select2 mb-3 border-bottom">
                                        <label class="px-0" for="userSelectProvince">Province*</label>
                                        <select class="form-select px-0 border-0 rounded-0" id="editprovince"
                                            aria-label="Floating label select">
                                            <option value="1" selected>Jawa Timur</option>
                                            <option value="2">Jawa Tengah</option>
                                            <option value="3">Jawa Barat</option>
                                        </select>
                                    </div>

                                    <div class="form-select2 mb-3 border-bottom">
                                        <label class="px-0" for="userSelectCity">City*</label>
                                        <select class="form-select px-0 border-0 rounded-0" id="editcity"
                                            aria-label="Floating label select">
                                            <option value="1" selected>Surabaya</option>
                                            <option value="2">Sidoarjo</option>
                                            <option value="3">Mojokerto</option>
                                        </select>
                                    </div>

                                    <div class="form-floating mb-3 border-bottom">
                                        <input type="text" class="form-control px-0 border-0 rounded-0"
                                            id="editpost_code" placeholder="Post Code">
                                        <label class="px-0" for="userTextZIP">Post Code*</label>
                                    </div>

                                    <div class="form-floating mb-3 border-bottom">
                                        <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="editaddress1"></textarea>
                                        <label class="px-0" for="userTextareaAddress1">Address 1*</label>
                                    </div>

                                    <div class="form-floating mb-3 border-bottom">
                                        <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="editaddress2"></textarea>
                                        <label class="px-0" for="userTextareaAddress2">Address 2 (Optioanal)</label>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> --}}
                        <button type="button" onclick="editAddress()" class="btn btn-primary">Update Recipients</button>
                    </div>
                </form>
            </div>
        </div>
    </div>