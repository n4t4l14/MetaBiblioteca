<?xml version="1.0" encoding="utf-8" standalone="yes" ?>
<Libros>
    <Libro>
        <Titulo>{{ $book->title }}</Titulo>
        <Isbn>{{$book->isbn}}</Isbn>
        <Autores>
        @foreach($book->authors->toArray() as $author)
                <Autor>{{ $author['name'] }}</Autor>
        @endforeach
        </Autores>
        <Caratula>{{ $book->cover_large }}</Caratula>
    </Libro>
</Libros>
