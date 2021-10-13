<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tambah</title>
</head>
<body>
    <form action="{{ url('simpanuji') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="token" value="$2y$10$kIAxk2KCirEdUXMv8iuX6OkLHP6ha.XIbSkIrN1HcLga9zEi4/sLa">
        <input type="hidden" name="lapak_id" value="2">
        <input type="text" name="nama">
        <input type="text" name="keterangan">
        <input type="text" name="harga">
        <input type="file" name="gambar">

        <input type="submit" value="simpan">
    </form>
</body>
</html>