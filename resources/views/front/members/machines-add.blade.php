<div class="accordion-item">
    <div id="userAddMachines" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
        <div class="accordion-body">

            <div class="form-floating border-bottom mb-1">
                <input type="text" class="form-control rounded-0 border-0 bg-transparent px-0" id="machinesSN"
                    placeholder="Serial Number">
                <label class="px-0" for="machinesSN">Serial Number</label>
            </div>
            <p><a href="#" target="_blank" class="mb-3">How to find my machine serial number</a></p>
            <div class="form-floating border-bottom mb-3">
                <input type="text" class="form-control rounded-0 border-0 bg-transparent px-0"
                    id="machinesOutletName" placeholder="Serial Number">
                <label class="px-0" for="machinesOutletName">Outlet Name</label>
            </div>
            <div class="form-floating border-bottom mb-3">
                <input type="text" class="form-control rounded-0 border-0 bg-transparent px-0" id="machinesCity"
                    placeholder="Serial Number">
                <label class="px-0" for="machinesCity">City</label>
            </div>
            <div class="form-floating border-bottom mb-5">
                <input type="text" class="form-control rounded-0 border-0 bg-transparent px-0"
                    id="machinesDatePurchase" placeholder="Serial Number">
                <label class="px-0" for="machinesDatePurchase">Date of Purchase</label>
            </div>

            <div class="mb-5" style="max-width: 320px;">
                <label for="formFile" class="form-label">Photo Invoice:</label>
                <input class="form-control" type="file" id="formFile">
            </div>

            <input class="form-control" type="text" id="email" value="{{ Str::ucfirst(Auth::user()->email) }}">

            <button class="btn btn-primary" onclick="addmachines()">
                Add Machines
            </button>

        </div>
    </div>
</div>
<script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>
<script>
    function addmachines() {
        alert("ini di addmachines");
        //$('#loading').collapse('show');

        var bodyFormData = new FormData();
        bodyFormData.append('machinesSN', document.getElementById("machinesSN").value)
        bodyFormData.append('machinesOutletName', document.getElementById("machinesOutletName").value)
        bodyFormData.append('machinesCity', document.getElementById("machinesCity").value)
        bodyFormData.append('machinesDatePurchase', document.getElementById("machinesDatePurchase").value)
        bodyFormData.append('file', $('#formFile')[0].files[0]);
        bodyFormData.append('email', document.getElementById("email").value);
        axios({
                method: 'post',
                url: '../api/postmachines',
                data: bodyFormData,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            .then(response => {
                console.log(response.data)
                //console.log(response.data.length)
                location.reload();

            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }
</script>
