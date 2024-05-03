@extends('../../front/layout')
@section('konten')
    <!-- coba -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-auto">
                    <header class="py-4 mb-4 mb-lg-5 d-none d-lg-block">
                        <div class="fs-2 fs-lg-3"><strong class="gotham-bold">Welcome.</strong></div>
                    </header>
                    @include('front/members/menu')
                </div>
                <div class="col-lg-9">
                    @include('front/members/header')


                    <!-- accordion user -->
                    <div class="accordion" id="accordionUser">
                        <hr class="opacity-50 m-0 d-lg-none">
                        <!-- ====================================== USER DASHBOAR ====================================== -->
                        @include('front/members/dashboard-user')
                        <hr class="opacity-50 m-0 d-lg-none">
                        <!-- ====================================== USER REDEEM ====================================== -->
                        @include('front/members/redeem-user')
                        <hr class="opacity-50 m-0 d-lg-none">
                        <!-- ====================================== USER REDEEM HISTORY ====================================== -->
                        @include('front/members/redeem-history')
                        <hr class="opacity-50 m-0 d-lg-none">
                        <!-- ====================================== USER ACCOUNT INFORMATION ====================================== -->
                        @include('front/members/account-information-user')
                        <hr class="opacity-50 m-0 d-lg-none">
                        <!-- ====================================== USER ORDERS ====================================== -->
                        @include('front/members/orders-user')
                        <hr class="opacity-50 m-0 d-lg-none">
                        <!-- ====================================== USER MACHINES ====================================== -->
                        @include('front/members/machines-list')
                        <hr class="opacity-50 m-0 d-lg-none">
                        <!-- ====================================== USER ADD MACHINES ====================================== -->
                        @include('front/members/machines-add')


                        <div class="accordion-item">
                            <div class="accordion-header d-lg-none">
                                <div class="d-lg-none">
                                    {{-- <button id="btnUserLogout" class="btn btn-user collapsed">
                                        <span class="me-3">logout ajah</span>
                                    </button> --}}
                                    <a class="btn btn-user collapsed" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">  
                                        <span class="me-3">Logout</span></a>
                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                              @csrf
                                          </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('popup')
    <!-- OFFCANVAS SIDE PANEL MEMBERSHIP GRADE -->
    @include('front/members/side-panel-membership-info')

    <!-- MODAL DETAILS ORDER -->
    @include('front/members/orders-list')

    <!-- MODAL ADD RECIPIENTS -->

    @include('front/members/recipients-add')
    
    <!-- MODAL EDIT RECIPIENTS -->
    @include('front/members/recipients-edit')
    
@endsection

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<Script>
    window.onload = function() {
        getAddress();
        getMerchandise();
        getVouchers();
        getMembersVouchers();
        console.log("onload");
    }

   //  function UpdateMember() {
   //      alert("update Member");
   //  }

   //  function clearTable() {

   //      var elmtTable = document.getElementById('tablerecepient');
   //      var tableRows = elmtTable.getElementsByTagName('tr');
   //      var rowCount = tableRows.length;
   //      for (var x = rowCount - 1; x > 0; x--) {
   //          elmtTable.deleteRow(x);
   //      }

   //  }

   //  function getAddress() {
   //      var bodyFormData = new FormData();
   //      bodyFormData.append('idmembers', document.getElementById('idmembers').value);
   //      axios({
   //              method: 'post',
   //              url: `http://127.0.0.1:8000/api/getMemberAddress`,
   //              data: bodyFormData,
   //          })
   //          .then(response => {
   //              console.log(response.data)
   //              console.log(response.data.length)
   //              var table = document.getElementById("tablerecepient");

   //              for (let i = 0; i < response.data.length; i++) {
   //                  var row = table.insertRow(i + 1);
   //                  var id = row.insertCell(0);
   //                  var subject = row.insertCell(1);
   //                  var recepient = row.insertCell(2);
   //                  var phone = row.insertCell(3);
   //                  var country = row.insertCell(4);

   //                  var province = row.insertCell(5);
   //                  var city = row.insertCell(6);
   //                  var post_code = row.insertCell(7);
   //                  var address1 = row.insertCell(8);
   //                  var action = row.insertCell(9);

   //                  var no = +i + 1;
   //                  id.innerHTML = no + ".";
   //                  subject.innerHTML = (response.data[i].subject);
   //                  recepient.innerHTML = (response.data[i].recepient);
   //                  phone.innerHTML = (response.data[i].phone);
   //                  email.innerHTML = (response.data[i].email);
   //                  country.innerHTML = (response.data[i].country);
   //                  province.innerHTML = (response.data[i].province);
   //                  city.innerHTML = (response.data[i].city);
   //                  post_code.innerHTML = (response.data[i].post_code);
   //                  address1.innerHTML = ((response.data[i].address1) + " " + (response.data[i].address2));
   //                  action.innerHTML = "<button type='button' id='btnedit" + response.data[i].id +
   //                      "' name='button' class='btn btn-sm btn-secondary mx-1'>Edit</button><button type='button' id='btnerase" +
   //                      response.data[i].id +
   //                      "' name='button' class='btn btn-sm btn-outline-dark mx-1'>Erase</button>";
   //                  document.getElementById('btnedit' + response.data[i].id).onclick =
   //                      function() {
   //                          showEditAddress(
   //                              response.data[i].id,
   //                              i,
   //                              response.data[i].idmembers,
   //                              response.data[i].subject,
   //                              response.data[i].recepient,
   //                              response.data[i].phone,
   //                              response.data[i].email,
   //                              response.data[i].country,
   //                              response.data[i].province,
   //                              response.data[i].city,
   //                              response.data[i].post_code,
   //                              response.data[i].address1,
   //                              response.data[i].address2
   //                          );
   //                      }
   //                  document.getElementById('btnerase' + response.data[i].id).onclick =
   //                      function() {
   //                          deleteAddress(response.data[i].id);
   //                      }
   //              }
   //          })
   //          .catch(error => {
   //              console.log('Error:' + error.message);
   //          });
   //  }

   //  function setRedeem(idproduct) {

   //  }

   //  function getMembersVouchers() {
   //      var bodyFormData = new FormData();
   //      var url = "<?php echo url('/'); ?>";
   //      console.log(url);
   //      var membersvouchers = '';
   //      bodyFormData.append('idmembers', document.getElementById('idmembers').value);
   //      axios({
   //              method: 'post',
   //              url: `http://127.0.0.1:8000/api/getVouchersByIdMembers`,
   //              data: bodyFormData,
   //          })
   //          .then(response => {
   //              console.log(response.data);
   //              for (let m = 0; m < response.data.length; m++) {
   //                  if (response.data[m].type == 'persen') {
   //                      var content = '<div class="col-auto"><div class="card-vouchers">' + response.data[m]
   //                          .nominal + '% OFF <small>' + response.data[m].kodecoupon + '</small></div></div>';
   //                  }
   //                  membersvouchers = membersvouchers + content;
   //              }
   //              document.getElementById("membersvouchers").innerHTML = membersvouchers;
   //          })
   //          .catch(error => {
   //              console.log('Error:' + error.message);
   //          });
   //  }

   //  function getVouchers() {
   //      var url = "<?php echo url('/'); ?>";
   //      console.log(url);
   //      var vouchers = '';
   //      axios({
   //              method: 'get',
   //              url: `http://127.0.0.1:8000/api/getVouchersAll`,

   //          })
   //          .then(response => {

   //              console.log(response.data);
   //              for (let m = 0; m < response.data.length; m++) {
   //                  var actualpoint = (+document.getElementById("finalpoint").value) - (response.data[m].poinneed);
   //                  var form_open =
   //                      '<form action="{{ route('cart.store') }}" id="frm" method="POST" enctype="multipart/form-data"> @csrf ';
   //                  var form_input_redeem = '<input type="hidden" value="true" name="redeem">';
   //                  var form_input_id = '<input type="hidden" value="' + response.data[m].id + '" name="id">';
   //                  var form_input_name = '<input type="hidden" name="name" value="' + response.data[m].kodecoupon +
   //                      '">';
   //                  var form_input_price = '<input type="hidden" value="500" name="price" value=0>';
   //                  var form_input_qty = '<input type="hidden" id="hiddenqty" name="quantity" value="1">';
   //                  var form_input_gramature =
   //                      '<input type="hidden" id="hiddengramature"  name="gramature" value="100">';
   //                  var form_input_images = '<input type="hidden"  name="images" value="' + response.data[m]
   //                      .gambar + '">';
   //                  var form_iduser = '<input type="hidden" name="iduser" value="' + (document.getElementById(
   //                      "iduser").value) + '">';
   //                  var form_idproduct_redeem = '<input type="hidden" name="idproduct_redeem" value="' + response
   //                      .data[m].id + '">';
   //                  var form_member_point_origin = '<input type="hidden" name="member_point_origin" value="' + (
   //                      document.getElementById("finalpoint").value) + '">';
   //                  var form_member_point_redeem = '<input type="hidden" name="member_point_redeem" value="' +
   //                      response.data[m].poinneed + '">';
   //                  var persentage = Math.round(document.getElementById("finalpoint").value / (response.data[m]
   //                      .poinneed) * 100);
   //                  if (persentage > 100) {
   //                      persentage = 100;
   //                  }
   //                  var form_progress =
   //                      '<div class="progress"><div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: ' +
   //                      persentage + '%;">' + persentage + '%</div></div>';

   //                  var form_close = '';
   //                  if (document.getElementById("finalpoint").value < (response.data[m].poinneed)) {

   //                      form_close =
   //                          '<button disabled class="btn btn-sm    w-100" id="btnAddcart" onClick=setRedeem(' +
   //                          response.data[m].id_product + ')>Redeem<i class="bi bi-cart-plus"></i></button></form>';
   //                  } else {
   //                      form_close =
   //                          '<button class="btn btn-sm btn-primary w-100" id="btnAddcart" onClick=setRedeem(' +
   //                          response.data[m].id_product + ')>Redeem<i class="bi bi-cart-plus"></i></button></form>';
   //                  }

   //                  var form = form_open + form_input_redeem + form_input_id + form_input_name + form_input_price +
   //                      form_input_qty + form_input_gramature + form_input_images + form_iduser +
   //                      form_idproduct_redeem + form_member_point_origin + form_member_point_redeem +
   //                      form_progress + form_close;

   //                  vouchers = vouchers +
   //                      '<div class="col"><div class="card card-product border-0 rounded-0 text-center mb-4"><div class="card-header position-relative p-0 border-0 rounded overflow-hidden"><img src="../ui/img/' +
   //                      response.data[m].gambar +
   //                      '" class="img-fluid"></div><div class="card-body text-capitalize py-2 px-0"><div class="cart-title lh-sm small mb-2" style="min-height:60px"><span class="fw-bold">' +
   //                      response.data[m].kodecoupon + '</span></div><div class="cart-text my-1 gotham-bold">' +
   //                      response.data[m].poinneed + ' Beans</div>' + form + '</div></div></div>';

   //              }

   //              document.getElementById("vouchers").innerHTML = vouchers;



   //          })
   //          .catch(error => {
   //              console.log('Error:' + error.message);
   //          });
   //  }

   //  function getMerchandise() {
   //      var bodyFormData = new FormData();
   //      var merchandise = '';
   //      bodyFormData.append('idmembers', document.getElementById('idmembers').value);
   //      axios({
   //              method: 'post',
   //              url: `http://127.0.0.1:8000/api/getMerchandiseAll`,

   //          })
   //          .then(response => {

   //              for (let m = 0; m < response.data.length; m++) {
   //                  var actualpoint = (+document.getElementById("finalpoint").value) - (response.data[m].poinneed);
   //                  var form_open =
   //                      '<form action="{{ route('cart.store') }}" id="frm" method="POST" enctype="multipart/form-data"> @csrf ';
   //                  var form_input_redeem = '<input type="hidden" value="true" name="redeem">';
   //                  var form_input_id = '<input type="hidden" value="' + 'REDEEM-' + response.data[m].id_product +
   //                      '" name="id">';
   //                  var form_input_name = '<input type="hidden" name="name" value="' + response.data[m].name + '">';
   //                  var form_input_price = '<input type="hidden" value="0" name="price" value=0>';
   //                  var form_input_qty = '<input type="hidden" id="hiddenqty" name="quantity" value="1">';
   //                  var form_input_gramature =
   //                      '<input type="hidden" id="hiddengramature"  name="gramature" value="100">';
   //                  var form_input_images = '<input type="hidden"  name="images" value="' + response.data[m].img +
   //                      '">';

   //                  var form_iduser = '<input type="hidden" name="iduser" value="' + (document.getElementById(
   //                      "iduser").value) + '">';
   //                  var form_idproduct_redeem = '<input type="hidden" name="idproduct_redeem" value="' + response
   //                      .data[m].id_product + '">';
   //                  var form_member_point_origin = '<input type="hidden" name="member_point_origin" value="' + (
   //                      document.getElementById("finalpoint").value) + '">';
   //                  var form_member_point_redeem = '<input type="hidden" name="member_point_redeem" value="' +
   //                      response.data[m].poinneed + '">';
   //                  var form_member_point_actual = '<input type="hidden" name="member_point_actual" value="' +
   //                      actualpoint + '">';
   //                  // var form_redeem_description ='<input type="hidden" name="redeem_description" value=0>';
   //                  var persentage = Math.round(document.getElementById("finalpoint").value / (response.data[m]
   //                      .poinneed) * 100);

   //                  if (persentage > 100) {
   //                      persentage = 100;
   //                  }

   //                  var form_progress =
   //                      '<div class="progress"><div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: ' +
   //                      persentage + '%;">' + persentage + '%</div></div>';

   //                  var form_close = '';
   //                  if (document.getElementById("finalpoint").value < (response.data[m].poinneed)) {

   //                      form_close =
   //                          '<button disabled class="btn btn-sm    w-100" id="btnAddcart" onClick=setRedeem(' +
   //                          response.data[m].id_product + ')>Redeem<i class="bi bi-cart-plus"></i></button></form>';
   //                  } else {
   //                      form_close =
   //                          '<button class="btn btn-sm btn-primary w-100" id="btnAddcart" onClick=setRedeem(' +
   //                          response.data[m].id_product + ')>Redeem<i class="bi bi-cart-plus"></i></button></form>';
   //                  }

   //                  var form = form_open + form_input_redeem + form_input_id + form_input_name + form_input_price +
   //                      form_input_qty + form_input_gramature + form_input_images + form_iduser +
   //                      form_idproduct_redeem + form_member_point_origin + form_member_point_redeem +
   //                      form_member_point_actual + form_progress + form_close;

   //                  merchandise = merchandise +
   //                      '<div class="col"><div class="card card-product border-0 rounded-0 text-center mb-4"><div class="card-header position-relative p-0 border-0 rounded overflow-hidden"><img src="' +
   //                      response.data[m].images +
   //                      '" class="img-fluid"></div><div class="card-body text-capitalize py-2 px-0"><div class="cart-title lh-sm small mb-2" style="min-height:60px"><span class="fw-bold">' +
   //                      response.data[m].name + '</span></div><div class="cart-text my-1 gotham-bold">' + response
   //                      .data[m].poinneed + ' Beans</div>' + form + '</div></div></div>';

   //              }

   //              document.getElementById("merchandise").innerHTML = merchandise;


   //          })
   //          .catch(error => {
   //              console.log('Error:' + error.message);
   //          });
   //  }

   //  function showEditAddress(id, index, idmembers, subject, recepient, phone, email, country, province, city, post_code,
   //      address1, address2) {
   //      console.log(index)
   //      document.getElementById('editid').value = id;
   //      document.getElementById('index').value = index;
   //      document.getElementById('editidmembers').value = idmembers;
   //      document.getElementById('editsubject').value = subject;
   //      document.getElementById('editrecepient').value = recepient;
   //      document.getElementById('editphone').value = phone;
   //      document.getElementById('editemail').value = email;
   //      document.getElementById('editcountry').value = country;
   //      document.getElementById('editprovince').value = province;
   //      document.getElementById('editcity').value = city;
   //      document.getElementById('editpost_code').value = post_code;
   //      document.getElementById('editaddress1').value = address1;
   //      document.getElementById('editaddress2').value = address2;
   //      $('#modalEditRecipients').modal('show');
   //  }

   //  function editAddress() {
   //      var bodyFormData = new FormData();
   //      bodyFormData.append('id', document.getElementById('editid').value);
   //      bodyFormData.append('idmembers', document.getElementById('editidmembers').value);
   //      bodyFormData.append('subject', document.getElementById('editsubject').value);
   //      bodyFormData.append('recepient', document.getElementById('editrecepient').value);
   //      bodyFormData.append('phone', document.getElementById('editphone').value);
   //      bodyFormData.append('email', document.getElementById('editemail').value);
   //      bodyFormData.append('country', document.getElementById('editcountry').value);
   //      bodyFormData.append('province', document.getElementById('editprovince').value);
   //      bodyFormData.append('city', document.getElementById('editcity').value);
   //      bodyFormData.append('post_code', document.getElementById('editpost_code').value);
   //      bodyFormData.append('address1', document.getElementById('editaddress1').value);
   //      bodyFormData.append('address2', document.getElementById('editaddress2').value);

   //      axios({
   //              method: 'post',
   //              url: `http://127.0.0.1:8000/api/updateMemberAddress`,
   //              data: bodyFormData,
   //          })
   //          .then(response => {

   //              clearTable();
   //              getAddress();
   //              $('#modalEditRecipients').modal('hide');

   //          })
   //          .catch(error => {
   //              console.log('Error:' + error.message);
   //          });
   //  }

   //  function deleteAddress(id) {
   //      clearTable();
   //      var bodyFormData = new FormData();
   //      bodyFormData.append('id', id);

   //      axios({
   //              method: 'post',
   //              url: `http://127.0.0.1:8000/api/deleteMemberAddress`,
   //              data: bodyFormData,
   //          })
   //          .then(response => {
   //              clearTable();
   //              getAddress();
   //          })
   //          .catch(error => {
   //              console.log('Error:' + error.message);
   //          });
   //  }


   //  function saveAddress() {
   //      var table = document.getElementById("tablerecepient");
   //      var totalRowCount = table.rows.length;
   //      var nextrow = +totalRowCount + 1;
   //      var row = table.insertRow(totalRowCount);
   //      var bodyFormData = new FormData();
   //      bodyFormData.append('idmembers', document.getElementById('idmembers').value);
   //      bodyFormData.append('subject', document.getElementById('subject').value);
   //      bodyFormData.append('recepient', document.getElementById('recepient').value);
   //      bodyFormData.append('phone', document.getElementById('phone').value);
   //      bodyFormData.append('email', document.getElementById('email').value);
   //      bodyFormData.append('country', document.getElementById('country').value);
   //      bodyFormData.append('province', document.getElementById('province').value);
   //      bodyFormData.append('city', document.getElementById('city').value);
   //      bodyFormData.append('post_code', document.getElementById('post_code').value);
   //      bodyFormData.append('address1', document.getElementById('address1').value);
   //      bodyFormData.append('address2', document.getElementById('address2').value);

   //      axios({
   //              method: 'post',
   //              url: `http://127.0.0.1:8000/api/postMemberAddress`,
   //              data: bodyFormData,
   //          })
   //          .then(response => {
   //              clearTable();
   //              getAddress();

   //              $('#modalAddRecipients').modal('hide');

   //          })
   //          .catch(error => {
   //              console.log('Error:' + error.message);
   //          });
   //  }
</Script>
