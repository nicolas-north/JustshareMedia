@extends('template.layout')

@section('title', 'Partner Company Management | Just Share Roofing Media')

@section('description', 'Managing Partner Company')

@section('js_additional')
    <script src="/assets/js/components/bs-datatable.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable1').dataTable( {
                "order": [[ 0, "asc" ]]
            });
        });
    </script>
@endsection

@section('content')

    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row clearfix">

                <div class="col-md-9">

                <span style='float:right'>
                    <a href='{{ route('admin.partner-company.export') }}' class='btn btn-danger'>Export</a>
                    <a href='{{ route('admin.partner-company.add') }}' class='btn btn-primary'>Add</a>
                </span>

                    <div class="heading-block border-0">
                        <h3>Partner Company</h3>
                    </div>

                    <div class="clear"></div>

                    <div class="row clearfix">

                        <div class="col">

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <i class="icon-exclamation-triangle"></i> {{ session('error') }}
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    <i class="icon-check-circle"></i> {{ session('success') }}
                                </div>
                            @endif

                            <div>
                                <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subscriptions</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subscriptions</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach ($partnerCompanies as $partnerCompany)
                                        <tr>
                                            <td>{{ $partnerCompany->name }}</td>
                                            <td>
                                                @foreach($partnerCompany->subscriptions as $subscription)
                                                    {{ $subscription->user->company }} {!! !$subscription->pivot->is_percentage ? '$' : '' !!}{{ $subscription->pivot->commission }}{!! $subscription->pivot->is_percentage ? '%' : '' !!} <br>
                                                @endforeach
                                            </td>
                                            <td>{{ $partnerCompany->created_at }}</td>
                                            <td>
                                                <form action="{{route('admin.partner-company.delete')}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{ $partnerCompany->id }}">
                                                    <button class="button button-3d button-mini button-rounded button-red">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="w-100 line d-block d-md-none"></div>

                <div class="col-md-3">

                    <x-dashboard-menu/>

                </div>

            </div>

        </div>
    </div>

@endsection
