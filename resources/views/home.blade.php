<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>App MetaBiblioteca</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

</head>
<body>
<div class="container" style="margin-top: 30px">
    <table id="book_table" class="table table-striped table-bordered" >
        <thead>
        <tr>
            <th>ISBN</th>
            <th>Libro</th>
            <th>Acciones</th>
        </tr>
        </thead>
    </table>
</div>
</body>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script>
    $(document).ready( function () {
        var page = 1;
        var table = $('#book_table').DataTable( {
            searching: false,
            ordering: false,
            processing: true,
            serverSide: true,
            pageLength: 2,
            ajax: {
                url: "{{ route('api.get.books') }}",
                contentType: "application/json",
                data: function ( d ) {
                    d.page = d.draw;
                },
                dataFilter: function(data) {
                    var json = jQuery.parseJSON( data );
                    json.recordsTotal = json.meta.total;
                    json.recordsFiltered = json.meta.total;

                    return JSON.stringify( json );
                }
            },
            columns: [
                { data: "isbn" },
                { data: "title" },
                {
                    data: "isbn",
                    render: function (isbn) {
                        return `
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle btn-sm" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button class="dropdown-item text-danger" type="button" onclick="deleteBook(`+isbn+`)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-x" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707 6.854 9.854a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z"/>
                                          <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                          <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        `;
                    }
                }
            ]
        } );
    } );

    deleteBook = function (id) {
        url = "{{route('api.delete.book', '%id')}}";
        url = url.replace('%id', id)

        $.post(url, function (data) {
            alert('Libro eliminado con exito!');
            location.reload();
        }).fail(function() {
            alert( "error" );
        });
    }

    $('.container').on('.paginate_button', function() {
        alert('something')
    })
</script>
</html>
