@extends('admin.admin_master')

@section('dashboard_content')
{{-- @include('admin.dashboard_layout.breadcrumb', [
'name' => 'User',
'url' => "categories.index",
'section_name' => 'All User'
]) --}}
<section class="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">All User Table</h1>
            {{-- <a href="/register" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Create New User</a> --}}
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>User Name </th>
                                <th>User Email</th>
                                <th>User Phone Number </th>
                                <th>User Avatar</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>User Name </th>
                                <th>User Email</th>
                                <th>User Phone Number </th>
                                <th>User Avatar</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $item)
                            <tr role="row" class="odd">
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item->id }}</td>
                                <td class="sorting_1">{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone_number}}</td>
                                <td>
                                    <img src="{{ !empty($item->profile_photo_path) ? url('storage/profile-photos/'.$item->profile_photo_path) : url('storage/profile-photos/blank_profile_photo.jpg') }}"
                                        alt="" style="width:70px; height:40px;">
                                </td>
                                <td>
                                    <div class="input-group">

                                        <a href="{{ route('user.edit', $item) }}" class="btn btn-info"
                                            title="Edit Data"><i class="fa fa-pencil">Edit User</i></a>

                                        <form action="{{ route('user.destroy', $item) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <a href="" class="btn btn-danger" title="Delete Data" id="delete" onclick="event.preventDefault();
                                                                this.closest('form').submit();"><i
                                                    class="fa fa-trash"></i>Delete User</a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</section>
@endsection