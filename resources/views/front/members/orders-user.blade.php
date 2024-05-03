<div class="accordion-item">
    <div class="accordion-header d-lg-none">
       <button id="btnUserOrders" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userOrders">
          <span class="me-3">my orders</span> <i class="bi bi-chevron-down"></i>
       </button>
    </div>
    <div id="userOrders" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
       <div class="accordion-body">

          <div class="table-responsive mb-4">
             <table class="table table-borderless table-hover text-capitalize mb-3" style="min-width: 560px;">
                <thead class="border-bottom border-secondary">
                   <tr>
                      <th scope="col">#</th>
                      <th scope="col">orders</th>
                      <th scope="col" class="text-center">date</th>
                      <th scope="col" class="text-center">status</th>
                      <th scope="col" class="text-center">total</th>
                      <th scope="col" class="text-center">action</th>
                   </tr>
                </thead>
                <tbody>
                   @foreach ($ordersarray as $ordergroup)
                      <tr>
                      <th scope="row">{{$loop->index+1}}.</th>
                      <td>{{$ordergroup->nomerorder}}</td>
                      <td class="text-nowrap text-center">{{$ordergroup->tanggalorder}}</td>
                      <td class="text-nowrap text-center">{{$ordergroup->status}}</td>
                      <td class="text-nowrap text-center">{{$ordergroup->itemsubtotal}} k</td>
                      <td class="text-nowrap text-center">
                         <a data-bs-toggle="modal" href="#modalDetailOrder{{$loop->index+1}}" class="text-primary"><u>details</u></a>
                      </td>
                   </tr> 
                   @endforeach
                   
                </tbody>
             </table>
          </div>

       </div>
    </div>
 </div>