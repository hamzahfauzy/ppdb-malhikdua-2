<div class="form-group">
    <label for="">Nama</label>
    <input type="text" name="name" class=" form-control" value="{{old('name', $operator?->name)}}" required>
</div>
<div class="form-group">
    <label for="">Email</label>
    <input type="email" name="email" class=" form-control" value="{{old('email', $operator?->email)}}" required>
</div>
<div class="form-group">
    <label for="">Nomor WA (Contoh : 81234567890)</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">+62</span>
        </div>
        <input type="tel" pattern="^[1-9]\d*$" name="phone_number" value="{{old('phone_number', $operator?->phone_number)}}" class="form-control" required="required">
    </div>
</div>
<div class="form-group">
    <label for="">Password</label>
    <input type="password" name="password" class=" form-control" value="" {{$operator?->password ? '' : 'required'}}>
</div>