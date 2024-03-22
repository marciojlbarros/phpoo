<?php $this->layout('master', ['title' => $title]); ?>

<h1>User</h1>

<form action="/user/update/12" method="post">
    <input type="text" name="firstName" value="Marcio">
    <input type="text" name="lastName" value="Barros">
    <input type="text" name="email" value="marcio.barros@gmail.com">
    <input type="password" name="password" value="123">

    <button type="submit">Atualizar</button>
</form>


