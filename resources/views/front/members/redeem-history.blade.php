<div class="accordion-item">
    <div id="userRedeemHistory" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
       <div class="accordion-body">

          <div class="table-responsive mb-4">
             <table class="table table-borderless table-hover text-capitalize mb-3" style="min-width: 560px;">
                <thead class="border-bottom border-secondary">
                   <tr>
                      <th scope="col">#</th>
                      <th scope="col">transactions</th>
                      <th scope="col" class="text-center">date</th>
                      <th scope="col" class="text-center">poin</th>
                      <th scope="col" class="text-center">redeem</th>
                   </tr>
                </thead>
                <tbody>
                   @foreach ($GetHistoryRedeem_res as $itemorder)
                   <tr>
                      <th scope="row">{{$loop->index+1}}</th>
                      <td>{{$itemorder->namaproduk}}</td>
                      <td class="text-nowrap text-center">
                         {{$itemorder->tanggalredeem}}
                         
                      </td>
                      <td class="text-nowrap text-center">
                         {{$itemorder->total_point}} 
                         Beans</td>
                      <td class="text-nowrap text-center">{{$itemorder->member_point_redeem}} Beans</td>
                   </tr>
                   @endforeach
                  
                </tbody>
             </table>
          </div>

       </div>
    </div>
 </div>