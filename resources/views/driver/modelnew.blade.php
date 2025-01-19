<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> اضافة سائق جديد </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert-error" v-if="supplier_err !== ''">
                    <p style="color: red; font-size:18px"> @{{ supplier_err }} </p>
                </div>
                <form id="createsuplier" method="post" autocomplete="off" class="m-5">

                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1"> اسم السائق  </label>
                        <input type="text" class="form-control" value="" name="name">
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @click="newsuplier" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>
