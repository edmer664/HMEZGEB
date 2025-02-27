@extends('template.index')

@push('styles')
<style>
    .table-item-content { 
        /** Equivalent to pt-3 */
        padding-top:1rem!important;
    }

    #thead-actions {
        /** Fixed width, increase if adding addt. buttons **/
        width:120px;
    }

    input[type="checkbox"], label {
        cursor: pointer;
    }
    
    /*
            TEMPORARY
        */
    /* Suggestions items */
    .tagify__dropdown.customers-list .tagify__dropdown__item {
        padding: .5em .7em;
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 0 1em;
        grid-template-areas: "avatar name"
            "avatar email";
    }

    .tagify__dropdown.customers-list .tagify__dropdown__item:hover .tagify__dropdown__item__avatar-wrap {
        transform: scale(1.2);
    }

    .tagify__dropdown.customers-list .tagify__dropdown__item__avatar-wrap {
        grid-area: avatar;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        overflow: hidden;
        background: #EEE;
        transition: .1s ease-out;
    }

    .tagify__dropdown.customers-list img {
        width: 100%;
        vertical-align: top;
    }

    .tagify__dropdown.customers-list strong {
        grid-area: name;
        width: 100%;
        align-self: center;
    }

    .tagify__dropdown.customers-list span {
        grid-area: email;
        width: 100%;
        font-size: .9em;
        opacity: .6;
    }

    .tagify__dropdown.customers-list .addAll {
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
{{-- Button Group Navigation --}}
<div class="btn-group mb-3" role="group" aria-label="Button group with nested dropdown">
    <button role="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-deposit">
        <span class="icon text-white-50">
            <i class="fas fa-pen"></i>
        </span>
        <span class="text">New</span>
    </button> 
</div>

{{-- Page Content --}}
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                <thead>
                    <th id="thead-actions">Actions</th>
                    <th>Deposit Date</th>
                    <th>Deposit ID</th>
                    <th>Account</th>
                    <th>Label</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{-- <button type="button" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </button> --}}
                        </td>
                        <td>03-Mar-2022</td>
                        <td>DS003</td>
                        <td>Commercial Bank</td>
                        <td><span class="badge badge-primary">Self</span></td>
                        <td>21,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modals --}}
{{-- New Deposit --}}
<div class="modal fade" id="modal-deposit" tabindex="-1" role="dialog" aria-labelledby="modal-deposit-label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-deposit-label">New Deposit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-deposit" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="d_bank_account" class="col-sm-3 col-lg-2 col-form-label">Select Bank Acct.<span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-9 col-lg-4">
                            <input class="col-8 col-lg-7" id="d_bank_account" name='bank_account'>
                        </div>

                        <label for="d_deposit_date" class="col-sm-3 col-lg-2 col-form-label">Deposit Ticket Date<span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-9 col-lg-4">
                            <input type="date" class="form-control" id="d_deposit_ticket_date" name="deposit_ticket_date">
                        </div>
                    </div>
                    <div class="form-group row">
                        {{-- Temporarily blank first column --}}
                        <div class="col-lg-6 d-none d-lg-flex"></div>
                    </div>
                    <hr>
                    <h2>Undeposited Sales</h2>
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered" id="dataTables2" width="100%" cellspacing="0">
                            <thead>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Payment Method</th>
                                <th>Cheque/Reference #</th>
                                <th>Amount</th>
                                <th id="thead-actions">Deposit?</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-item-content">01/31/2022</td>
                                    <td class="table-item-content">PocketDevs</td>
                                    <td class="table-item-content">Cash</td>
                                    <td class="table-item-content"><label for="d_invoices_1483681825">1483681825</label></td>
                                    <td class="table-item-content">Birr 1,000</td>
                                    <td class="table-item-content">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="d_invoices_1483681825" name="invoices[]" value="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-item-content">02/01/2022</td>
                                    <td class="table-item-content">Fullstack HQ</td>
                                    <td class="table-item-content">Cheque</td>
                                    <td class="table-item-content"><label for="d_invoices_1483681826">1483681826</label></td>
                                    <td class="table-item-content">Birr 2,000</td>
                                    <td class="table-item-content">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="d_invoices_1483681826" name="invoices[]" value="">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <tfoot>
                                <th class="text-center">
                                    Total Cash<br>
                                    <b>7,000.00</b>
                                </th>
                                <th class="text-center">
                                    Total Cheque<br>
                                    <b>2,500.00</b>
                                </th>
                                <th class="text-center">
                                    Total Other<br>
                                    <b>0.00</b>
                                </th>
                                <th class="text-center">
                                    Total Deposit<br>
                                    <b>9,500.00</b>
                                </th>
                            </tfoot>
                        </table>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="d_remark" class="col-sm-3 col-form-label">Remark</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="d_remark" name="remark"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" form="form-deposit">Save Deposit</button>
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function () {
            $('#dataTables').DataTable();
            $('#dataTables2').DataTable();
            $('.dataTables_filter').addClass('pull-right');
        });
</script>
<script src="{{ asset('js/customer/deposit/template_select_bank.js') }}"></script>
<script src="{{ asset('js/customer/deposit/customer_deposit.js') }}"></script>
@endsection