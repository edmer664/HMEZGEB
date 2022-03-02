@extends('template.index')

@push('styles')
 {{-- <link rel="stylesheet" href="{{asset('css/.css')}}" /> --}}
 
@endpush

@section('content')

<div class="wrapper">

<div class="d-sm-flex align-items-start justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">Vendors</h1>
    <!--- card for account payable--->

    <div class="col-xl-3 col-md-6 mb-4 border-1">
        <div class="card border-left-primary shadow h-100 pt-2">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center">
                Account Payable 
                </div>
            </div>
            <div class="card-body">
                <div class="row no-gutters d-flex align-items-center justify-content-around">
                    <div class="h6 mb-0">
                    <span class="font-weight-bold text-gray-800">$40,000</span><br>
                    <small>Active</small>
                    </div>
                    <div class="h6 mb-0">
                    <span class="font-weight-bold text-danger">$3,500</span><br>
                    <small>Over Due</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center  justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary pr-3">List of Vendors</h6>

    <!--------BUTTONS---->
    <div class="d-flex justify-content-around">
    <!--------add vendor modal---->
    <button type="button" class="btn btn-info mx-1" data-toggle="modal" data-target=".bd-example-modal-xl">New Vendor</button>
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header d-flex">
                        <h3>Add Vendor</h3>
                        <a class="close" data-dismiss="modal">×</a>
                    </div>
                    <form id="contactForm" name="contact" role="form">
                       @include('vendors.vendors.forms.addVendorModal')
                        <div class="modal-footer">					
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" id="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      
    <!--------end of add vendor modal---->
    <div id="contact"><button type="button" class="btn btn-info btn mx-1" data-toggle="modal" data-target="#import">Import</button></div>
    <div id="contact"><button type="button" class="btn btn-info btn mx-1" data-toggle="modal" data-target="#import">Export</button></div>
    <div id="contact"><button type="button" class="btn btn-info btn mx-1" data-toggle="modal" data-target="#import">Download file</button></div>
    </div>         
</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%" id="dataTables" cellspacing="100">
                    <thead>
                        <tr>
                            <th>Vendor Name</th>
                            <th>TIN#</th>
                            <th>City</th>
                            <th>Contact Person</th>
                            <th>Mobile#</th>
                            <th>Lable</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        <tr onclick="window.location='/individualVendor'">
                            <td>PocketDevs</td>
                            <td>289123585</td>
                            <td>Cebu</td>
                            <td>Justin Manigo</td>
                            <td>09208765910</td>
                            <td><span class="badge badge-primary">VIP</span></td>
                            <td>12,000.00</td>
                        </tr>
                        <tr onclick="window.location='/individualVendor'">
                            <td>Pocketteams</td>
                            <td>362162217</td>
                            <td>Cebu</td>
                            <td>John Doe</td>
                            <td>09208642910</td>
                            <td><span class="badge badge-info">ISP</span></td>
                            <td>1,000.00</td>
                        </tr>
                        <tr onclick="window.location='/individualVendor'">
                            <td>IKEA</td>
                            <td>521677826</td>
                            <td>Manila</td>
                            <td>Jane Doe</td>
                            <td>09084378189</td>
                            <td><span class="badge badge-secondary">New</span></td>
                            <td>8,000.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>

 <script>
        $(document).ready(function () {
            $('#dataTables').DataTable();
            $('.dataTables_filter').addClass('pull-right');
        });

        //$('#details').trumbowyg();
        //$('#features').trumbowyg();

    </script>
@endsection