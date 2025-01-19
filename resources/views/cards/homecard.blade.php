<div class="row row-sm">
    {{-- <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card " style='background-color:#3f51b5 !important' >
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">بروفات </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white"> @{{ counts.rehearsal1 }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">بروفات </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

    <a href="{{ route('shiping.index',1) }}" class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">  رفح          </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        {{-- @foreach ( as $branche)
                        <option value="{{ $branche->id }}">{{ $branche->name }}</option>
                    @endforeach --}}
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white"> {{ \App\Models\Shipping::where('type', 1)->where('status', 1)->count() }} </h4>
                            {{-- <p class="mb-0 tx-12 text-white op-7">  الشحنات اليوم       </p> --}}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </a>
    <a href="{{ route('shiping.index',2) }}" class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white"> العوجه </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white"> {{ \App\Models\Shipping::where('type', 2)->where('status', 1)->count() }}</h4>
                            
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </a>
    <a href="{{ route('shiping.index',3) }}" class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">  الغاز  </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white"> {{ \App\Models\Shipping::where('type', 3)->where('status', 1)->count() }}</h4>
                           
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </a>

    <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card " style='background-color:#607d8b !important'>
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white"> الشحنات المنتهيه  </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white"> @{{counts.drayclean}}</h4>
                            <p class="mb-0 tx-12 text-white op-7"> الشحنات المنتهيه  </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
     <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card " style='background-color:#17a6ee !important'>
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white"> الشحنات المنتظره  </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white"> @{{counts.customers}}</h4>
                            <p class="mb-0 tx-12 text-white op-7"> الشحنات المنتظره   </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
    <div class="card overflow-hidden sales-card " style='background-color:#607d8b !important'>
        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
            <div class="">
                <h6 class="mb-3 tx-24 text-white"> الشحنات المنتهيه  </h6>
            </div>
            <div class="pb-0 mt-0">
                <div class="d-flex">
                    <div class="">
                        <h4 class="tx-20 font-weight-bold mb-1 text-white"> @{{counts.drayclean}}</h4>
                        <p class="mb-0 tx-12 text-white op-7"> الشحنات المنتهيه  </p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
