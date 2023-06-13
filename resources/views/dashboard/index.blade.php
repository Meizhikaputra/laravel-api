<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <a href="/dashboard/create" class="btn btn-info">Add new student</a>
    @if(session('success'))
      
      <div class="alert alert-success alert-dismissible fade show col-lg-8 mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session('delete'))
      
      <div class="alert alert-danger alert-dismissible fade show col-lg-8 mt-3" role="alert">
        {{ session('delete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">nim</th>
          <th scope="col">email</th>
          <th scope="col">jurusan</th>
          <th scope="col">Aksi</th>

        </tr>
      </thead>
      <tbody>
        @foreach($students as $student)
          
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $student->name }}</td>
          <td>{{ $student->nim }}</td>
          <td>{{ $student->email }}</td>
          <td>{{ $student->jurusan }}</td>
          <td>
              <a href="/students/{{ $student->name }}" class="btn bg-warning">show</a>  
              <a href="/students/{{ $student->name }}/edit" class="btn bg-info">edit</a> 
              <form action="/students/{{ $student->name }}" method="post" class="d-inline" onclick="return confirm('anda Yakin ingin menghapus?')">
              @method('delete')
              @csrf
              <button class="btn btn-danger" type="submit">delete</button>
              </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>