@extends('layouts.app')

@section('title','| Contact Message')

@push('css')

<link href="{{ asset('material_admin/assets/datatable/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('mamakitchen/css/toastr.min.css') }}">

@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">All Contact Message</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-primary">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Sent At</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $key=>$contact)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->created_at }}</td>
                                            <td>
                                                <a href="{{ route('contact.show',$contact->id) }}" class="btn btn-info btn-sm"><i class="material-icons">pageview</i></a>

                                                <form id="delete-form-{{ $contact->id }}" action="{{ route('contact.destroy',$contact->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $contact->id }}').submit();
                                                }else {
                                                    event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

<script src="{{ asset('material_admin/assets/datatable/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('material_admin/assets/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('material_admin/assets/datatable/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('mamakitchen/js/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>

@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    toastr.error('{{ $error }}');
</script>
@endforeach
@endif
{!! Toastr::message() !!}

@endpush