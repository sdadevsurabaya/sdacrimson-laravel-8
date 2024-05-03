<div class="accordion-item">
    <div class="accordion-header d-lg-none">
        <button id="btnUserAccount" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userAccount">
            <span class="me-3">my account information</span> <i class="bi bi-chevron-down"></i>
        </button>
    </div>
    <div id="userAccount" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
        <div class="accordion-body">

            <div class="row">
                <div class="col-12 mb-5">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-floating border-bottom mb-3">
                                <input type="text" class="form-control border-0 px-0 text-uppercase" id="userName"
                                    placeholder="First Name" value="{{ $GetMember->firstname }}">
                                <label for="userName" class="px-0">First Name*</label>
                            </div>

                            <div class="form-floating border-bottom mb-3">
                                <input type="text" class="form-control border-0 px-0 text-uppercase"
                                    id="userLastname" placeholder="Last Name" value="{{ $GetMember->lastname }}">
                                <label for="userLastname" class="px-0">Last Name*</label>
                            </div>

                            <div class="form-floating border-bottom mb-3">
                                @if (empty($GetMember->lahirtgl))
                                    <input type="text" class="form-control border-0 px-0 text-uppercase"
                                        id="userBirth" placeholder="Date of Birth" value="please insert your birth day">
                                @else
                                    <input type="text" class="form-control border-0 px-0 text-uppercase"
                                        id="userBirth" placeholder="Date of Birth" value="{{ $GetMember->lahirtgl }} ">
                                @endif
                                <label for="userBirth" class="px-0">Date of Birth</label>
                            </div>

                            <div class="form-floating border-bottom mb-3">
                                <input type="text" class="form-control border-0 px-0 text-uppercase" id="userCompany"
                                    placeholder="Company">
                                <label for="userCompany" class="px-0">Company</label>
                            </div>

                            <div class="form-floating border-bottom mb-3">
                                <input type="email" class="form-control border-0 px-0 text-lowercase" id="userEmail"
                                    placeholder="Email" value="{{ $GetMember->email }}">
                                <label for="userEmail" class="px-0">Email*</label>
                            </div>

                            <div class="form-floating border-bottom mb-3">
                                <input type="text" class="form-control border-0 px-0 text-uppercase" id="userPhone"
                                    placeholder="Phone Number" value="{{ $GetMember->notelp }}">
                                <label for="userPhone" class="px-0">Phone Number*</label>
                            </div>

                        </div>
                        <div class="col-lg-6">

                            <div class="form-select2 mb-3 border-bottom">
                                <label class="px-0" for="userSelectCountry">Country*</label>
                                <select class="form-select px-0 border-0 rounded-0" id="userSelectCountry"
                                    aria-label="Floating label select">
                                    <option selected>Indonesia</option>
                                    <option value="2">Singapore</option>
                                    <option value="3">Malaysia</option>
                                </select>
                            </div>

                            <div class="form-select2 mb-3 border-bottom">
                                <label class="px-0" for="userSelectProvince">Province*</label>
                                <select class="form-select px-0 border-0 rounded-0" id="userSelectProvince"
                                    aria-label="Floating label select">
                                    <option value="1" selected>Jawa Timur</option>
                                    <option value="2">Jawa Tengah</option>
                                    <option value="3">Jawa Barat</option>
                                </select>
                            </div>

                            <div class="form-select2 mb-3 border-bottom">
                                <label class="px-0" for="userSelectCity">City*</label>
                                <select class="form-select px-0 border-0 rounded-0" id="userSelectCity"
                                    aria-label="Floating label select">
                                    <option value="1" selected>Surabaya</option>
                                    <option value="2">Sidoarjo</option>
                                    <option value="3">Mojokerto</option>
                                </select>
                            </div>

                            <div class="form-floating mb-3 border-bottom">
                                <input type="text" class="form-control px-0 border-0 rounded-0" id="userTextZIP"
                                    placeholder="Post Code" value="{{ $GetMember->kodepos }}">
                                <label class="px-0" for="userTextZIP">Post Code*</label>
                            </div>

                            <div class="form-floating mb-3 border-bottom">
                                <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="userTextareaAddress1">{{ $GetMember->alamat }} </textarea>
                                <label class="px-0" for="userTextareaAddress1">Address 1*</label>
                            </div>

                            <div class="form-floating mb-3 border-bottom">
                                <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="userTextareaAddress2"></textarea>
                                <label class="px-0" for="userTextareaAddress2">Address 2 (Optional)</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <button class="btn btn-primary" onclick="UpdateMember()" style="min-width: 250px;">Update Account
                        {{-- (id: {{$GetMember->id}} / id_user_login : {{$GetMember->id_users_login}} ) --}}
                    </button>
                    <a href="#" class="btn border-0"><u>Reset/ Change Password ?</u></a>
                </div>
                <div class="col-12 mb-5">
                    <button data-bs-toggle="modal" data-bs-target="#modalAddRecipients" class="btn btn-secondary"
                        style="min-width: 250px;">Add Recipients</button>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="tablerecepient" class="table table-hover text-nowrap" style="width: 860px;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Recipient</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Province</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Post Code</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<Script>
    //function update data member
    function UpdateMember() {
        alert("update Member");
    }

    //function clear data tabel recepient
    function clearTable() {

        var elmtTable = document.getElementById('tablerecepient');
        var tableRows = elmtTable.getElementsByTagName('tr');
        var rowCount = tableRows.length;
        for (var x = rowCount - 1; x > 0; x--) {
            elmtTable.deleteRow(x);
        }

    }

    //function untuk mengambil data alamat recepient
    function getAddress() {
        var bodyFormData = new FormData();
        bodyFormData.append('idmembers', document.getElementById('idmembers').value);
        axios({
                method: 'post',
                // url: `http://127.0.0.1:8000/api/getMemberAddress`,
                //url: `https://project-supresso.suryoatmojo.id/api/getMemberAddress`,
                url: 'api/getMemberAddress',
                data: bodyFormData,
            })
            .then(response => {
                console.log(response.data)
                console.log(response.data.length)
                var table = document.getElementById("tablerecepient");

                for (let i = 0; i < response.data.length; i++) {
                    var row = table.insertRow(i + 1);
                    var id = row.insertCell(0);
                    var subject = row.insertCell(1);
                    var recepient = row.insertCell(2);
                    var phone = row.insertCell(3);
                    var country = row.insertCell(4);

                    var province = row.insertCell(5);
                    var city = row.insertCell(6);
                    var post_code = row.insertCell(7);
                    var address1 = row.insertCell(8);
                    var action = row.insertCell(9);

                    var no = +i + 1;
                    id.innerHTML = no + ".";
                    subject.innerHTML = (response.data[i].subject);
                    recepient.innerHTML = (response.data[i].recepient);
                    phone.innerHTML = (response.data[i].phone);
                    email.innerHTML = (response.data[i].email);
                    country.innerHTML = (response.data[i].country);
                    province.innerHTML = (response.data[i].province);
                    city.innerHTML = (response.data[i].city);
                    post_code.innerHTML = (response.data[i].post_code);
                    address1.innerHTML = ((response.data[i].address1) + " " + (response.data[i].address2));
                    action.innerHTML = "<button type='button' id='btnedit" + response.data[i].id +
                        "' name='button' class='btn btn-sm btn-secondary mx-1'>Edit</button><button type='button' id='btnerase" +
                        response.data[i].id +
                        "' name='button' class='btn btn-sm btn-outline-dark mx-1'>Erase</button>";
                    document.getElementById('btnedit' + response.data[i].id).onclick =
                        function() {
                            showEditAddress(
                                response.data[i].id,
                                i,
                                response.data[i].idmembers,
                                response.data[i].subject,
                                response.data[i].recepient,
                                response.data[i].phone,
                                response.data[i].email,
                                response.data[i].country,
                                response.data[i].province,
                                response.data[i].city,
                                response.data[i].post_code,
                                response.data[i].address1,
                                response.data[i].address2
                            );
                        }
                    document.getElementById('btnerase' + response.data[i].id).onclick =
                        function() {
                            deleteAddress(response.data[i].id);
                        }
                }
            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }


    function showEditAddress(id, index, idmembers, subject, recepient, phone, email, country, province, city, post_code,
        address1, address2) {
        console.log(index)
        document.getElementById('editid').value = id;
        document.getElementById('index').value = index;
        document.getElementById('editidmembers').value = idmembers;
        document.getElementById('editsubject').value = subject;
        document.getElementById('editrecepient').value = recepient;
        document.getElementById('editphone').value = phone;
        document.getElementById('editemail').value = email;
        document.getElementById('editcountry').value = country;
        document.getElementById('editprovince').value = province;
        document.getElementById('editcity').value = city;
        document.getElementById('editpost_code').value = post_code;
        document.getElementById('editaddress1').value = address1;
        document.getElementById('editaddress2').value = address2;
        $('#modalEditRecipients').modal('show');
    }

    function editAddress() {
        var bodyFormData = new FormData();
        bodyFormData.append('id', document.getElementById('editid').value);
        bodyFormData.append('idmembers', document.getElementById('editidmembers').value);
        bodyFormData.append('subject', document.getElementById('editsubject').value);
        bodyFormData.append('recepient', document.getElementById('editrecepient').value);
        bodyFormData.append('phone', document.getElementById('editphone').value);
        bodyFormData.append('email', document.getElementById('editemail').value);
        bodyFormData.append('country', document.getElementById('editcountry').value);
        bodyFormData.append('province', document.getElementById('editprovince').value);
        bodyFormData.append('city', document.getElementById('editcity').value);
        bodyFormData.append('post_code', document.getElementById('editpost_code').value);
        bodyFormData.append('address1', document.getElementById('editaddress1').value);
        bodyFormData.append('address2', document.getElementById('editaddress2').value);

        axios({
                method: 'post',
                // url: `http://127.0.0.1:8000/api/updateMemberAddress`,
                // url: `https://project-supresso.suryoatmojo.id/api/updateMemberAddress`,
                url: 'api/updateMemberAddress',
                
            })
            .then(response => {

                clearTable();
                getAddress();
                $('#modalEditRecipients').modal('hide');

            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }

    function deleteAddress(id) {
        clearTable();
        var bodyFormData = new FormData();
        bodyFormData.append('id', id);

        axios({
                method: 'post',
                // url: `http://127.0.0.1:8000/api/deleteMemberAddress`,
                //url: `https://project-supresso.suryoatmojo.id/api/deleteMemberAddress`,
                url: 'api/deleteMemberAddress',
                data: bodyFormData,
            })
            .then(response => {
                clearTable();
                getAddress();
            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }


    function saveAddress() {
        var table = document.getElementById("tablerecepient");
        var totalRowCount = table.rows.length;
        var nextrow = +totalRowCount + 1;
        var row = table.insertRow(totalRowCount);
        var bodyFormData = new FormData();
        bodyFormData.append('idmembers', document.getElementById('idmembers').value);
        bodyFormData.append('subject', document.getElementById('subject').value);
        bodyFormData.append('recepient', document.getElementById('recepient').value);
        bodyFormData.append('phone', document.getElementById('phone').value);
        bodyFormData.append('email', document.getElementById('email').value);
        bodyFormData.append('country', document.getElementById('country').value);
        bodyFormData.append('province', document.getElementById('province').value);
        bodyFormData.append('city', document.getElementById('city').value);
        bodyFormData.append('post_code', document.getElementById('post_code').value);
        bodyFormData.append('address1', document.getElementById('address1').value);
        bodyFormData.append('address2', document.getElementById('address2').value);

        axios({
                method: 'post',
                // url: `http://127.0.0.1:8000/api/postMemberAddress`,
                //url: `https://project-supresso.suryoatmojo.id/api/postMemberAddress`,
                url: 'api/postMemberAddress',
                data: bodyFormData,
            })
            .then(response => {
                clearTable();
                getAddress();

                $('#modalAddRecipients').modal('hide');

            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }
</Script>
