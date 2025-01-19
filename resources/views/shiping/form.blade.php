<form id="createEmployee" method="post" autocomplete="off">
    @csrf
    <input  class="form-control"  name="type_id" value="{{ $shiping->type }}" type="hidden">
    <div class="row">
        <div class="row mt-4">
            <input class="form-control" name="shiping_id" value="{{ $shiping->id }}" placeholder="00" type="hidden">
            <input v-if="editid" class="form-control" v-model="editid" name="editid" placeholder="00" type="hidden">
            <div class="col-lg-3 ">
                <p class="mg-b-10"> السائق
                    <a style="color: red" type="button" data-target="#exampleModal" data-toggle="modal">
                        اضافة
                        سائق </a>
                </p>
                
                <select id="driver_idd"  name="driver_id" class="form-control select2">
                    <option value="" selected> -- السائق --</option>
                    <option v-for="(st , sti) in drivers" :key="sti" :value="st.id">
                        @{{ st.name }} </option>
                </select>
            </div>

            <div class="col-lg-3 ">
                <label class="form-label"> رقم السياره </label>
                <input  class="form-control" v-model="car_number" name="car_number"
                    placeholder="00" type="text">
            </div>
            <div class="col-lg-3">
                <label class="form-label"> رقم المقطوره </label>
                <input  class="form-control" v-model="trailer_number"
                    name="trailer_number" placeholder="00" type="text">
            </div>
            <div class="col-lg-3 ">
                <label class="form-label"> تاريخ الوصول </label>
                <input class="form-control" id="charge_date" @change="clothdate" 
                v-model="charge_date"
                    name="charge_date" type="date">
            </div>
            @if ($shiping->type == 1)
                {{-- // لو الشحنه رفح  --}}
                <div class="col-lg-3 ">
                    <label class="form-label"> تاريخ التحميل </label>
                    <input class="form-control" id="charge_datetwo" name="charge_datetwo" v-model="charge_datetwo" type="date">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label"> فرق التحميل </label>
                    <input class="form-control" readonly v-model="tahmel_between" name="tahmel_between" placeholder="00"
                        type="text">
                </div>
            @endif
            <div class="col-lg-3 ">
                <label class="form-label"> فرق الوصول </label>
                <input class="form-control" readonly v-model="charge_between" name="charge_between" placeholder="00"
                    type="text">
            </div>
            <div class="col-lg-3 ">
                <label class="form-label"> تاريخ التعتيق </label>
                <input class="form-control" @change="calcdays" id="decharge_date" v-model="decharge_date" name="decharge_date"
                    type="date">
            </div>
            <div class="col-lg-3 ">
                <label class="form-label"> النولون </label>
                <input class="form-control" @keyup="calc" v-model.number="nolon" name="nolon" placeholder="00"
                    type="text">
            </div>

            <div class="col-lg-3 ">
                @if ($shiping->type !== 3)
                <label class="form-label"> تحميل </label>
                @else
                <label class="form-label"> طلعه </label>
                @endif
                <input class="form-control" @keyup="calc" name="tax" v-model.number="tax" placeholder="00"
                    type="text">
            </div>

            {{-- لو الشحنه مش غاز --}}
            @if ($shiping->type !== 3)
                {{-- <div class="col-lg-3 ">
                    <label class="form-label"> جمرك </label>
                    <input class="form-control" @keyup="calc" name="gmrok" v-model.number="gmrok" placeholder="00"
                        type="text">
                </div> --}}
                <div class="col-lg-3 ">
                    <label class="form-label"> طرق </label>
                    <input class="form-control" @keyup="calc" name="karta" v-model.number="karta"
                        placeholder="00" type="text">
                </div>
                {{-- <div class="col-lg-3 ">
                    <label class="form-label"> بسكول ميزان </label>
                    <input class="form-control" @keyup="calc" name="mizan" v-model.number="mizan"
                        placeholder="00" type="text">
                </div> --}}
                <div class="col-lg-3 ">
                    <label class="form-label"> معديه </label>
                    <input class="form-control" @keyup="calc" name="kobry" v-model.number="kobry"
                        placeholder="00" type="text">
                </div>
            @endif
            @if ($shiping->type !== 2)
                <div class="col-lg-3 ">
                    <label class="form-label"> تحويله </label>
                    <input class="form-control" @keyup="calc" name="transfar" v-model.number="transfar"
                        placeholder="00" type="text">
                </div>
            @endif
            @if ($shiping->type !== 3)
                    
                <div class="col-lg-3 ">
                    <label class="form-label"> الشرائح </label>
                    <input class="form-control" name="leaval" @keyup="calc" v-model.number="leaval"
                        placeholder="00" type="text">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label"> محافظه </label>
                    <input class="form-control" name="goverment" @keyup="calc" v-model.number="goverment"
                        placeholder="00" type="text">
                </div>

                {{-- تلغي رقح وغاز  --}}
                
                <div class="col-lg-3 ">
                    <label class="form-label"> باب المينا </label>
                    <input class="form-control" name="enamel_door" @keyup="calc" v-model.number="enamel_door"
                        placeholder="00" type="text">
                </div>
            @endif
            <div class="col-lg-3 ">
                <label class="form-label">  مبيت الوصول</label>
                <input class="form-control" readonly name="overnight" @keyup="calc" v-model.number="overnight"
                    placeholder="00" type="text">
            </div>
            {{-- لو مش رفح  --}}
            @if ($shiping->type !== 1)
            <div class="col-lg-3 ">
                <label class="form-label"> رسوم ميزان </label>
                <input class="form-control" name="balance_fees" @keyup="calc" v-model.number="balance_fees"
                    placeholder="00" type="text">
            </div>
            <div class="col-lg-3 ">
                <label class="form-label"> دخول </label>
                <input class="form-control" name="entry" @keyup="calc" v-model.number="entry"
                    placeholder="00" type="text">
            </div>
            
            
            <div class="col-lg-3 ">
                <label class="form-label"> مبيت هيئه</label>
                <input class="form-control" name="overnight2" @keyup="calc" v-model.number="overnight2"
                    placeholder="00" type="text">
            </div>
            @endif
            {{-- // لو الشحنه رفح  --}}
            @if ($shiping->type == 1)
             

                <div class="col-lg-3 ">
                    <label class="form-label"> بسكول ميزان </label>
                    <input class="form-control" @keyup="calc" name="mizan" v-model.number="mizan"
                        placeholder="00" type="text">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label"> حفر </label>
                    <input class="form-control" name="digging" @keyup="calc" v-model.number="digging"
                        placeholder="00" type="text">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label">  مبيت السائق </label>
                    <input class="form-control" readonly name="overnightdriv" @keyup="calc" v-model.number="overnightdriv"
                        placeholder="00" type="text">
                </div>
            @endif
            {{-- // لو الشحنه غاز  --}}
            @if ($shiping->type == 3)
                <div class="col-lg-3 ">
                    <label class="form-label"> شعاع </label>
                    <input class="form-control" @keyup="calc" name="shoaa" v-model.number="shoaa"
                        placeholder="00" type="text">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label"> تحميل تنكات </label>
                    <input class="form-control" @keyup="calc" name="tankat" v-model.number="tankat"
                        placeholder="00" type="text">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label"> شريحه فارغ </label>
                    <input class="form-control" name="blank_slice" @keyup="calc" v-model.number="blank_slice"
                        placeholder="00" type="text">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label"> شريحه محمل </label>
                    <input class="form-control" name="full_slice" @keyup="calc" v-model.number="full_slice"
                        placeholder="00" type="text">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label"> معديه فارغ </label>
                    <input class="form-control" name="slice_kopry" @keyup="calc" v-model.number="slice_kopry"
                        placeholder="00" type="text">
                </div>
                <div class="col-lg-3 ">
                    <label class="form-label"> معديه محمل </label>
                    <input class="form-control" name="full_kopry" @keyup="calc" v-model.number="full_kopry"
                        placeholder="00" type="text">
                </div>
                {{-- <div class="col-lg-3 ">
                    <label class="form-label">  رسم ميزان </label>
                    <input class="form-control" name="entrance_fees" @keyup="calc" v-model.number="entrance_fees"
                        placeholder="00" type="text">
                </div> --}}
                <div class="col-lg-3 ">
                    <label class="form-label"> حراسه </label>
                    <input class="form-control" name="gard" @keyup="calc" v-model.number="gard"
                        placeholder="00" type="text">
                </div>
            @endif

            <div class="col-lg-3 ">
                <label class="form-label"> اجمالي الشركة </label>
                <input class="form-control" name="totalone" readonly @keyup="calc" v-model.number="totalone"
                    placeholder="00" type="text">
            </div>
            <div class="col-lg-3 ">
                <label class="form-label"> اجمالي السائق </label>
                <input class="form-control" name="drivermony" readonly @keyup="calc" v-model="drivermony"
                    placeholder="00" type="text">
            </div>
           
            @if ($shiping->type !== 1)
            {{-- تلغي رفح   --}}
            <div class="col-lg-3 ">
                <label class="form-label"> مبيت هيئة المندوب </label>
                <input class="form-control" name="accommodation" @keyup="calc" v-model.number="accommodation"
                    placeholder="00" type="text">
            </div>
            @endif

            {{-- <div class="col-lg-3 ">
            <label class="form-label"> مدفوعات المندوب </label>
            <input class="form-control"  name="delegate_payments" placeholder="00" type="text">
        </div> --}}
            <div class="col-lg-3 ">
                <label class="form-label"> العهده </label>
                <input class="form-control" name="covenant" @keyup="calc" v-model.number="covenant"
                    placeholder="00" type="text">
            </div>
            {{-- <div class="col-lg-3 ">
            <label class="form-label"> الاجمالي </label>
            <input class="form-control"  name="totaltwo" placeholder="00" type="text">
        </div> --}}
            {{-- <div class="col-lg-3 ">
            <label class="form-label"> المدفوع </label>
            <input class="form-control"  name="paid" placeholder="00" type="text">
        </div> --}}
            <div class="col-lg-3 ">
                <label class="form-label"> سلفه </label>
                <input class="form-control" name="discount" @keyup="calc" v-model.number="discount"
                    placeholder="00" type="text">
            </div>
            <div class="col-lg-3 ">
                <label class="form-label">  الصافى  </label>
                <input class="form-control" name="due" readonly @keyup="calc" v-model.number="due"
                    placeholder="00" type="text">
            </div>
            
        </div>
    </div>
    <div class="modal-footer" style="justify-content:flex-start !important">
        <button type="button" @click="saveData" v-show="!editid" class="btn btn-primary">حفظ</button>
        <button type="button" @click="saveData" v-show="editid" class="btn btn-warning"> حفظ التعديل </button>
        <button type="button" @click="createnew" v-show="editid" class="btn btn-danger"> انشاء جديد </button>
    </div>

</form>
