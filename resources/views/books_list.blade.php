<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Vue Mastery</title>
    <!-- Import Styles -->
    <link rel="stylesheet" href="{{asset('assets/styles.css')}}" />
    <!-- Import Vue.js -->
    <script src="https://unpkg.com/vue@3.0.0-beta.12/dist/vue.global.js"></script>
</head>
<body>
<div class="nav-bar"></div>
<div id="app">
    <book-list></book-list>
{{--    <div class="cart">Cart({{ cart.length }})</div>--}}
{{--    <product-display--}}
{{--        :premium="premium"--}}
{{--        @add-to-cart="updateCart"--}}
{{--        @remove-from-cart="removeById"> <!-- solution -->--}}
{{--    </product-display>--}}
</div>

<!-- Import App -->
<script src="{{asset('js/main.js')}}"></script>

<!-- Import Components -->
<script src="{{asset('components/BooksList.js')}}"></script>
{{--<script src="./components/ReviewForm.js"></script>--}}
{{--<script src="./components/ReviewList.js"></script>--}}

{{--<!-- Mount App -->--}}
<script>
    const mountedApp = app.mount('#app');
</script>
</body>
</html>
