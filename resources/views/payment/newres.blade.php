<div class="modal" id="modaldemo3" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">سند جديد</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form  id='recip' >
                    {{ csrf_field() }}

                    <div class="form-group col-8">
                        <label for="exampleInputEmail1">رقم الفاتورة</label>
                        <input type="text" class="form-control"  v-model='bill_number' name="bill_id">
                        <span v-show='errornum' class='btn-danger'>    @{{msg}}   </span>
                    </div>
                    <div class=" col-3">
                        <button type="button" @click='getBill' class="btn_add btn btn-primary"> بحث</button>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> الاسم </label>
                        <input type="text" class="form-control" readonly v-model='customer_name' >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> المطلوب </label>
                        <input type="text" class="form-control" readonly name="total_before" v-model='total_before' >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">المدفوع</label>
                        <input type="text" class="form-control" @change='account'  name="amount" v-model='amount'>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> الباقي </label>
                        <input type="text" class="form-control" readonly name="total_after"  v-model='total_after'>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">تاريخ الدفع</label>
                        <input class="form-control fc-datepicker" name="paid_date" placeholder="YYYY-MM-DD"
                               type="date" value="{{ date('Y-m-d') }}" @unlessrole('admin') readonly @endunlessrole required>
                    </div>

                    @role('admin')
                    <div class="form-group">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الفرع</label>
                        <select name="branch_id" id="branch_id" class="form-control" >
                            <option value="" selected > --حدد الفرع--</option>
                            <option v-for='b in data.branches' :value="b.id"  > @{{b.branch_name}} </option>
                        </select>
                    </div>
                    @endrole
                    <div class="form-group">
                        <label for="exampleInputEmail1">تاريخ الاستحقاق</label>
                        <input class="form-control fc-datepicker" name="residual_date" placeholder="YYYY-MM-DD"
                               type="date" value="{{ date('Y-m-d') }}"  required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">الملاحظات</label>
                        <input type="text" class="form-control" id="notes" name="notes">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" @click='create' class="btn btn-primary">حفظ</button>

                        <button type="button"   class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>