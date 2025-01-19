<div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> عرض </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="printher">
                <div class="row">
                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> السائق </label>
                        <input type="text" readonly class="form-control" v-model="data.drivername">
                    </div>
                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> رقم السياره </label>
                        <input type="text" readonly class="form-control" v-model="data.car_number">
                    </div>
                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> رقم المقطوره </label>
                        <input type="text" readonly class="form-control" v-model="data.trailer_number">
                    </div>

                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> تاريخ الوصول </label>
                        <input type="text" readonly class="form-control" v-model="data.charge_date">
                    </div>
                    @if ($shiping->type == 1)
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> تاريخ التحميل </label>
                            <input type="text" readonly class="form-control" v-model="data.charge_datetwo">
                        </div>
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> فرق التحميل </label>
                            <input type="text" readonly class="form-control" v-model="data.tahmel_between">
                        </div>
                    @endif

                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> فرق الوصول </label>
                        <input type="text" readonly class="form-control" v-model="data.charge_between">
                    </div>


                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> تاريخ التعتيق </label>
                        <input type="text" readonly class="form-control" v-model="data.decharge_date">
                    </div>

                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> النولون </label>
                        <input type="text" readonly class="form-control" v-model="data.nolon">
                    </div>


                    <div class="col-md-3 ">
                        @if ($shiping->type !== 3)
                            <label for="signup-name"> تحميل </label>
                        @else
                            <label for="signup-name"> طلعه </label>
                        @endif

                        <input id="signup-name" type="text" readonly class="form-control" v-model="data.tax"
                            autocomplete="off" />
                    </div>
                    {{-- <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> تحميل </label>
                        <input type="text" readonly class="form-control" v-model="data.tax">
                    </div> --}}
                    {{-- <div class="col-md-6 ">
                        <label for="exampleInputEmail1"> جمرك </label>
                        <input type="text" readonly class="form-control" v-model="data.gmrok">
                    </div> --}}
                    {{-- لو مش غاز  --}}
                    @if ($shiping->type !== 3)
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> طرق </label>
                            <input type="text" readonly class="form-control" v-model="data.karta">
                        </div>
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> معديه </label>
                            <input type="text" readonly class="form-control" v-model="data.kobry">
                        </div>
                    @endif


                    @if ($shiping->type !== 1)
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> رسوم ميزان </label>
                            <input type="text" readonly class="form-control" v-model="data.balance_fees">
                        </div>
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> دخول </label>
                            <input type="text" readonly class="form-control" v-model="data.entry">
                        </div>
                        <div class="col-lg-3 ">
                            <label class="form-label"> مبيت هيئه</label>
                            <input class="form-control" readonly v-model="data.overnight2" placeholder="00"
                                type="text">
                        </div>
                    @endif



                    {{-- لو مش العوجه --}}
                    @if ($shiping->type !== 2)
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> تحويله </label>
                            <input type="text" readonly class="form-control" v-model="data.transfar">
                        </div>
                    @endif
                    @if ($shiping->type !== 3)
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> الشرائح </label>
                            <input type="text" readonly class="form-control" v-model="data.leaval">
                        </div>
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> محافظه </label>
                            <input type="text" readonly class="form-control" v-model="data.goverment">
                        </div>

                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> باب المينا </label>
                            <input type="text" readonly class="form-control" v-model="data.enamel_door">
                        </div>
                        {{-- <div class="col-md-6 ">
                        <label for="exampleInputEmail1"> مبيت </label>
                        <input type="text" readonly class="form-control" v-model="data.overnight">
                    </div> --}}
                    @endif
                    {{-- لو رفح  --}}
                    @if ($shiping->type == 1)
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> بسكول ميزان </label>
                            <input type="text" readonly class="form-control" v-model="data.mizan">
                        </div>
                    @endif
                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> مبيت الوصول</label>
                        <input type="text" readonly class="form-control" v-model="data.overnight">
                    </div>

                    {{-- // لو الشحنه رفح  --}}
                    @if ($shiping->type == 1)
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> حفر </label>
                            <input type="text" readonly class="form-control" v-model="data.digging">
                        </div>
                        {{-- <div class="col-md-6 ">
                        <label for="exampleInputEmail1"> ردم </label>
                        <input type="text" readonly class="form-control" v-model="data.backfilling">
                    </div> --}}
                    @endif
                    {{-- // لو الشحنه غاز  --}}
                    @if ($shiping->type == 3)
                        <div class="col-lg-3 ">
                            <label class="form-label"> شعاع </label>
                            <input class="form-control" readonly v-model="data.shoaa" placeholder="00"
                                type="text">
                        </div>
                        <div class="col-lg-3 ">
                            <label class="form-label"> تحميل تنكات </label>
                            <input class="form-control" readonly v-model="data.tankat" placeholder="00"
                                type="text">
                        </div>

                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> شريحه فارغ </label>
                            <input type="text" readonly class="form-control" v-model="data.blank_slice">
                        </div>
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> شريحه محمل </label>
                            <input type="text" readonly class="form-control" v-model="data.full_slice">
                        </div>
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> معديه فارغ </label>
                            <input type="text" readonly class="form-control" v-model="data.slice_kopry">
                        </div>
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1">معديه محمل </label>
                            <input type="text" readonly class="form-control" v-model="data.full_kopry">
                        </div>

                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> حراسه </label>
                            <input type="text" readonly class="form-control" v-model="data.gard">
                        </div>
                    @endif
                    @if ($shiping->type == 1)
                        <div class="col-md-3 ">
                            <label for="exampleInputEmail1"> مبيت سائق </label>
                            <input type="text" readonly class="form-control" v-model="data.overnightdriv">
                        </div>
                    @endif
                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> اجمالي الشركه </label>
                        <input type="text" readonly class="form-control" v-model="data.totalone">
                    </div>
                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> اجمالي السائق </label>
                        <input type="text" readonly class="form-control" v-model="data.drivermony">
                    </div>
                    @if ($shiping->type !== 1)
                        {{-- تلغي رفح   --}}
                        <div class="col-lg-3 ">
                            <label class="form-label"> مبيت هيئة المندوب </label>
                            <input class="form-control" readonly v-model="data.accommodation" placeholder="00"
                                type="text">
                        </div>
                    @endif
                    {{-- <div class="col-md-6 ">
                        <label for="exampleInputEmail1"> مبيت هيئة المندوب  </label>
                        <input type="text" readonly class="form-control" v-model="data.accommodation">
                    </div> --}}

                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> العهده </label>
                        <input type="text" readonly class="form-control" v-model="data.covenant">
                    </div>
                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> سلفه </label>
                        <input type="text" readonly class="form-control" v-model="data.discount">
                    </div>
                    <div class="col-md-3 ">
                        <label for="exampleInputEmail1"> الصافي </label>
                        <input type="text" readonly class="form-control" v-model="data.due">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" aria-label="Print"
                    onclick="__print_receipt('printher');"><i class="fa fa-print"></i> طباعه
                </button>
            </div>
        </div>
    </div>
</div>
