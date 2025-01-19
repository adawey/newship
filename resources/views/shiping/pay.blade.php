<div class="modal fade" id="exampleModalpay" tabindex="-1" aria-labelledby="exampleModalpay" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalpay"> عرض </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="printher">


                    <div class="col-md-6 ">
                        <label for="exampleInputEmail1"> الصافي </label>
                        <input type="text" readonly class="form-control" v-model="data.due">
                    </div>
                    <div class="col-md-6 ">
                        <label for="exampleInputEmail1"> تم الدفع </label>
                        <input type="text" readonly class="form-control" v-model="amountpay">
                    </div>
                    <div class="col-12 mt-3">
                        <div class="col-md-12 ">
                            <label for="exampleInputEmail1">  المتبقي </label>
                            <input type="text" readonly class="form-control" style="color: red"
                                v-model='nm'>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <form id='recip'>
                            <input type="hidden" class="form-control" name="id"
                            v-model='data.id'>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <label for="exampleInputEmail1">المدفوع</label>
                                    <input type="text" class="form-control" @keyup='account' name="paym"
                                        v-model='paym'>
                                </div>
                                <div class="col-md-6 ">
                                    <label for="exampleInputEmail1"> الباقي </label>
                                    <input type="text" class="form-control" name="residual" v-model='residual'>
                                </div>
                            </div>
                            <button type="button" @click="savepayment" :disabled="!savepay"  class="btn btn-primary mt-2">حفظ</button>
                        </form>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary" aria-label="Print" 
                onclick="__print_receipt('printher');"><i class="fa fa-print"></i> طباعه
                </button> --}}
            </div>
        </div>
    </div>
</div>
