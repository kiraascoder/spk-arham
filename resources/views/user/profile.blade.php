@extends('layouts.dashboard')

@section('content')
    <div class="form-box">
        <h3 style="margin-bottom: 20px;">Profile User</h3>

        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" value="Arham" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="arham@mail.com" readonly>
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <input type="text" class="form-control" value="User" readonly>
        </div>
    </div>
@endsection
