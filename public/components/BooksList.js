app.component('book-list', {
    props: {
        book: {
            type: Object,
            required:true
        }
    },
    template:
    /*html*/
    `
        <div class="books-list">
            <h3>Libros registrado</h3>
            <table class="table">

            </table>
        </div>
    `,
    data() {
        return {

        };
    }
});
