<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <form class="d-flex justify-content-center mt-5 gap-4" method="post" action="{{route('category.update', $category->id)}}"
            enctype="multipart/form-data">
            @csrf
            @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
            <table>
                <tr>
                    <td><label for="name">Nama Kategori </label></td>
                    <td><input type="text" name="name" id="name" value="{{$category['name']}}"></td>
                </tr>
                <tr>
                    <td><label for="description">description </label></td>
                    <td><input type="text" name="description" id="description " value="{{$category['description']}}"></td>
                </tr>
                <tr>
                    <td><label for="icon">icon </label></td>
                    <td><input type="file" name="icon" id="icon" accept="jpeg,png,jpg"></td>
                </tr>
                <tr>
                    <td><button type="submit">Simpan</button></td>  
                </tr>
            </table>
        </form>
    </div>
</body>

</html>