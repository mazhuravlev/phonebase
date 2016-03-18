<h2>Поиск номера телефона</h2>
<form action="{{env('APP_URL')}}/search" method="post">
    <input class="form-control" type="text" placeholder="номер телефона" name="phone">
    <button class="btn btn-primary btn-raised" type="submit">поиск</button>
</form>