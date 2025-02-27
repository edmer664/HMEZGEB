@extends('template.index')


@push('styles')
<style>
    .table-item-content {
        /** Equivalent to pt-3 */
        padding-top: 1rem !important;
    }

    .thead-actions {
        /** Fixed width, increase if adding addt. buttons **/
        width: 120px;
    }

    .content-card {
        border-radius: 0px 0px 5px 5px;
    }

    .inputPrice::-webkit-inner-spin-button,
    .inputTax::-webkit-inner-spin-button,
    .inputPrice::-webkit-outer-spin-button,
    .inputTax::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="checkbox"],
    label {
        cursor: pointer;
    }

    /*
            TEMPORARY
        */
    /* Suggestions items */
    .tagify__dropdown.banks-list .tagify__dropdown__item {
        padding: .5em .7em;
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 0 1em;
        grid-template-areas: "avatar name"
            "avatar email";
    }

    .tagify__dropdown.banks-list .tagify__dropdown__item:hover .tagify__dropdown__item__avatar-wrap {
        transform: scale(1.2);
    }

    .tagify__dropdown.banks-list .tagify__dropdown__item__avatar-wrap {
        grid-area: avatar;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        overflow: hidden;
        background: #EEE;
        transition: .1s ease-out;
    }

    .tagify__dropdown.banks-list img {
        width: 100%;
        vertical-align: top;
    }

    .tagify__dropdown.banks-list strong {
        grid-area: name;
        width: 100%;
        align-self: center;
    }

    .tagify__dropdown.banks-list span {
        grid-area: email;
        width: 100%;
        font-size: .9em;
        opacity: .6;
    }

    .tagify__dropdown.banks-list .addAll {
        border-bottom: 1px solid #DDD;
        gap: 0;
    }


    /* Tags items */
    .tagify__tag {
        white-space: nowrap;
    }

    .tagify__tag:hover .tagify__tag__avatar-wrap {
        transform: scale(1.6) translateX(-10%);
    }

    .tagify__tag .tagify__tag__avatar-wrap {
        width: 16px;
        height: 16px;
        white-space: normal;
        border-radius: 50%;
        background: silver;
        margin-right: 5px;
        transition: .12s ease-out;
    }

    .tagify__tag img {
        width: 100%;
        vertical-align: top;
        pointer-events: none;
    }
</style>

<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<div class="row">

    {{-- Main Content Section --}}
    <div class="col-xl-12 col-lg-12 col-12">
     {{-- Button Group Navigation --}}
        <div class="btn-group mb-3" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#modal-customer">
                <span class="icon text-white-50">
                    <i class="fas fa-exchange-alt"></i>
                </span>
                <span class="text">Transfer</span>
            </button>
          
        </div>
        {{-- Button Group Navigation --}}
        {{-- <div class="btn-group mb-3" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="icon text-white-50">
                        <i class="fas fa-pen"></i>
                    </span>
                    <span class="text">New</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a role="button" class="dropdown-item" data-toggle="modal" data-target="#modal-receipt">Receipt</a>
                    <a role="button" class="dropdown-item" data-toggle="modal" data-target="#modal-advance-revenue">Advance Revenue</a>
                    <a role="button" class="dropdown-item" data-toggle="modal" data-target="#modal-credit-receipt">Credit Receipt</a>
                    <a role="button" class="dropdown-item" data-toggle="modal" data-target="#modal-proforma">Proforma</a>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-import">
                <span class="icon text-white-50">
                    <i class="fas fa-file-import"></i>
                </span>
                <span class="text">Import</span>
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-export">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">Export</span>
            </button>
            <button type="button" class="btn btn-secondary">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">Download Excel Format</span>
            </button>    
        </div> --}}

        {{-- Tab Navigation --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="transactions-tab" data-toggle="tab" href="#transactions" role="tab" aria-controls="transactions" aria-selected="true">Transfer History</a>
            </li>
        </ul>
        
        {{-- Tab Contents --}}
        <div class="card" class="content-card">
            <div class="card-body tab-content" id="myTabContent">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="tab-pane fade show active" id="transactions" role="tabpanel" aria-labelledby="transactions-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">                        
                            <thead>
                                
                                <th>Date</th>
                                <th>Reference</th>
                                <th>From Bank</th>
                                <th>To Bank</th>
                                <th>Amount</th>
                                <th>Reason</th>
                                <th class="thead-actions">Actions</th>
                                 
                            </thead>
                            <tbody>
                                @foreach($transfers as $transfer)
                                <tr>
                                    <td class="table-item-content">{{ $transfer->created_at->format('d-m-Y') }}</td>
                                    <td class="table-item-content">{{$transfer->id}}</td>
                                    <td class="table-item-content">{{$transfer->fromAccount->bank_branch}}</td>
                                    <td class="table-item-content">{{$transfer->toAccount->bank_branch}}</td>
                                    <td class="table-item-content">{{$transfer->amount}}</td>
                                    <td class="table-item-content">{{$transfer->reason}}</td>
                                    <td>
                                        <button type="button" class="btn btn-small btn-icon btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-small btn-icon btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </td> 	 	  
                                  
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
</div>


{{-- Transfer Modal --}}
<div class="modal fade" id="modal-customer" tabindex="-1" role="dialog" aria-labelledby="modal-customer-label" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-customer-label">New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('transfers.transfer.store')}}" id="form-transfer" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="t_bank_from" class="col-sm-3 col-lg-4 col-form-label">Send From<span class="text-danger ml-1"></span></label>
                        <div class="col-sm-9 col-lg-12 mb-3 mb-lg-0">
                            <input type="text" class="form-control" id="t_bank_from"  placeholder="" required>
                            <input type="hidden" id="t_bank_id_from"  name="from_account_id" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_amount" class="col-sm-3 col-lg-4 col-form-label">Amount</label>
                        <div class="col-sm-9 col-lg-12 mb-3 mb-lg-0">
                            <input type="number" class="form-control" id="t_amount" name="amount" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_bank_to" class="col-sm-3 col-lg-6 col-form-label">Destination Account</label>
                        <div class="col-sm-9 col-lg-12 mb-3 mb-lg-0">
                            <input type="text" class="form-control" id="t_bank_to" name="bank_to" placeholder="" required>
                            <input type="hidden" id="t_bank_id_to" name="to_account_id" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_reason" class="col-sm-3 col-lg-4 col-form-label">Reason</label>
                        <div class="col-sm-9 col-lg-12 mb-3 mb-lg-0">
                            <textarea class="form-control" id="t_reason" name="reason" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="form-transfer">Transfer Amount</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    $('#dataTables').DataTable();
    $('.dataTables_filter').addClass('pull-right');
    });
</script>
<script src="/js/banking/template_select_bank.js"></script>
<script src="/js/banking/transfer/select_bank.js"></script>

@endsection